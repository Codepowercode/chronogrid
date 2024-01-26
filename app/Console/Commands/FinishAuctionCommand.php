<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductAuction;
use Illuminate\Console\Command;

class FinishAuctionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'edit status_finish in auction where finished';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Product::where('auction', 1)->where('auction_end', '<', date('Y-m-d H:m:s',time()))->update(['auction_status_finish' => 1])->pluck('id');
        $auction = ProductAuction::whereIn('product_id', $products)->update(['status_finish' => 1]);
    }
}
