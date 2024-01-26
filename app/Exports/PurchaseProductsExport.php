<?php


namespace App\Exports;


use App\Http\Resources\Order\Excel\PurchasesHistoryResources;
use App\Models\Order;
use App\Models\Product;
use App\MyHellepr\Hellper;
use Maatwebsite\Excel\Concerns\FromCollection;

class PurchaseProductsExport implements FromCollection
{

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $orders = Order::query()->with(['product'])->where('buyer_id', $this->id)->orderBy('id', 'DESC')->get();

        $kay = 1;
        $zero = 0;
       if (!isset($orders[0]->id))  return abort(404, "You have no orders");
        foreach ($orders as $order){
            if ($zero == 0){
                $output[0]["id"] = 'Id';
                $output[0]["buyer_name"] ='Buyer Name';
                $output[0]["buyer_email"] ='Buyer Email';
                $output[0]["seller_name"] ='Seller Name';
                $output[0]["seller_email"] = 'Seller Email';
                $output[0]["quantity"] = 'Quantity';
                $output[0]["price"] = 'Price';
                $output[0]["original_price"] = 'Original price';
                $output[0]["type"] = 'Type';
                $output[0]["pdf"] = 'Url invoice pdf';
                $output[0]["shipping"] = 'Shipping';
                $output[0]["track_number"] = 'Track Number';
                $output[0]["delivery"] = 'Delivery';
                $output[0]["history"] = 'History';
                $output[0]["auction"] = 'Auction';
                $output[0]["status"] = 'Status';
                $output[0]["canceled_user_id"] = 'Canceled User Id';
                $output[0]["created_at"] = 'Created at';
                $output[0]["updated_at"] = 'Updated at';
                $output[0]["product_id"] = 'Product Id';
                $output[0]["product_company_name"] = 'Product Company Name';
                $output[0]["product_brand"] = 'Product Brand';
                $output[0]["product_description"] = 'Product description';
                $output[0]["product_model_number"] = 'Product model number';
                $output[0]["product_model"] = 'Product model';
                $output[0]["product_color"] = 'Product color';
                $output[0]["product_size"] = 'Product size';
                $output[0]["product_metal"] = 'Product metal';
                $output[0]["product_bezel_size"] = 'Product bezel size';
                $output[0]["product_bezel_type"] = 'Product bezel type';
                $output[0]["product_bezel_metal"] = 'Product bezel metal';
                $output[0]["product_bracelet_type"] = 'Product bracelet type';
                $output[0]["product_condition"] = 'Product condition';
                $output[0]["product_more_condition"] = 'Product more condition';
                $output[0]["product_band"] = 'Product band';
                $output[0]["product_dial_type"] = 'Product dial type';
                $output[0]["product_year"] = 'Product year';
                $output[0]["product_quantity"] = 'Product quantity';
                $output[0]["product_note"] = 'Product note';
                $output[0]["product_price"] = 'Product price';
                $output[0]["product_auction"] = 'Product auction';
                $output[0]["product_auction_price"] = 'Product auction price';
                $output[0]["product_auction_min_bid"] = 'Product auction min bid';
                $output[0]["product_auction_start"] = 'Product auction start';
                $output[0]["product_auction_end"] = 'Product auction end';
                $output[0]["product_status"] = 'Product status';
                $zero = 1;
            }
                $output[$kay]["id"] = $order->id;
                $output[$kay]["buyer_name"] = Hellper::filterUserResource($order->buyer_id)['name'];
                $output[$kay]["buyer_email"] = Hellper::filterUserResource($order->buyer_id)['email'];
                $output[$kay]["seller_name"] = Hellper::filterUserResource($order->seller_id)['name'];
                $output[$kay]["seller_email"] = Hellper::filterUserResource($order->seller_id)['email'];
                $output[$kay]["quantity"] = $order->quantity;
                $output[$kay]["price"] = $order->price;
                $output[$kay]["original_price"] = $order->original_price;
                $output[$kay]["type"] = $order->type;
                $output[$kay]["pdf"] = $order->pdf;
                $output[$kay]["shipping"] = $order->shipping;
                $output[$kay]["track_number"] = $order->track_number;
                $output[$kay]["delivery"] = $order->delivery;
                $output[$kay]["history"] = $order->history;
                $output[$kay]["auction"] = $order->auction;
                $output[$kay]["status"] = $order->status;
                $output[$kay]["canceled_user_id"] = $order->canceled_user_id;
                $output[$kay]["created_at"] = $order->created_at;
                $output[$kay]["updated_at"] = $order->updated_at;
                $output[$kay]["product_id"] = $order->product->id;
                $output[$kay]["product_company_name"] = Hellper::filterUserResource($order->product->user_id)['name'];
                $output[$kay]["product_brand"] = $order->product->brand;
                $output[$kay]["product_description"] = $order->product->description;
                $output[$kay]["product_model_number"] = $order->product->model_number;
                $output[$kay]["product_model"] = $order->product->model;
                $output[$kay]["product_color"] = $order->product->color;
                $output[$kay]["product_size"] = $order->product->size;
                $output[$kay]["product_metal"] = $order->product->metal;
                $output[$kay]["product_bezel_size"] = $order->product->bezel_size;
                $output[$kay]["product_bezel_type"] = $order->product->bezel_type;
                $output[$kay]["product_bezel_metal"] = $order->product->bezel_metal;
                $output[$kay]["product_bracelet_type"] = $order->product->bracelet_type;
                $output[$kay]["product_condition"] = $order->product->condition;
                $output[$kay]["product_more_condition"] = $order->product->more_condition;
                $output[$kay]["product_band"] = $order->product->band;
                $output[$kay]["product_dial_type"] = $order->product->dial_type;
                $output[$kay]["product_year"] = $order->product->year;
                $output[$kay]["product_quantity"] = $order->product->quantity;
                $output[$kay]["product_note"] = $order->product->note;
                $output[$kay]["product_price"] = $order->product->price;
                $output[$kay]["product_auction"] = $order->product->auction;
                $output[$kay]["product_auction_price"] = $order->product->auction_price;
                $output[$kay]["product_auction_min_bid"] = $order->product->auction_min_bid;
                $output[$kay]["product_auction_start"] = $order->product->auction_start;
                $output[$kay]["product_auction_end"] = $order->product->auction_end;
                $output[$kay]["product_status"] = $order->product->status;
                $kay++;
        }
//        $output = PurchasesHistoryResources::collection($orders);

//        dd($output);
        return collect($output);
    }


}
