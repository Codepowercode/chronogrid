<?php

namespace App\Jobs;

use App\Mail\AccessCodeMail;
use App\Mail\UserEventMail;
use App\Models\OrderOffer;
use App\Models\Product;
use App\Models\ProductAuction;
use App\Models\User;
use App\MyHellepr\Hellper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProductEndAuctionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $product = Product::findOrFail($this->product_id);
        $product->update(
            [
                'status' => 0,
                'auction_status_finish' => 1,
            ]
        );


        $auctionsCount = ProductAuction::query()->where('product_id', $this->product_id)->count();

        if ($auctionsCount){
            $auctions = ProductAuction::query()->where('product_id', $this->product_id);
            foreach ($auctions as $auctionWinner){
                $auctionWinner->update(['status_finish' => 1]);
            }
            $auction = $auctions->orderByDesc('id')->first();
            $auction->update(['status_winner' => 1]);
            Hellper::userEvent(true, $auction->user_id, 'auction', $auction, "You win auction", json_encode($auction));
            Hellper::userEvent(true, $auction->user_id, 'auction', $auction, "Winner auction defined", json_encode($auction));
        }else{
            Hellper::userEvent(true, $product->user_id, 'auction', $product, "No auction bidder");
        }

    }
}
