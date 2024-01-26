<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\Offer\GetOffers;
use App\Models\Order;
use App\Models\OrderOffer;
use App\Models\Product;
use App\Models\ProductAuction;
use App\MyHellepr\Hellper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function getOffersBuyerOrSeller($type, $offer, $delivery)
    {
        $offerReplay = [];
        $code = 401;
        $status = false;
        $message = 'please send in get {seller or buyer}';
        if ($type == 'seller' || $type == 'buyer'){
//        type -> [ seller or buyer ]
            $offerReplay = OrderOffer::query()->with('order', 'product')->where('type', $offer)->where($type.'_id', Hellper::companyId());
            if (in_array($delivery, OrderOffer::typeOfDeliveryOffer())){
                $offerReplay = $offerReplay->where('delivery', $delivery);
            }

            $offerReplay = $offerReplay->orderBy('id', 'DESC')->paginate(10);


            $code = 200;
            $status = true;
            $message = 'Offers '.$type;
        }
        return response()->json(
            [
                "status"=> $status,
                "message"=> $message,
                "request"=> 'Request data [ '.$type.' ]',
                "user"=> Hellper::companyId(),
                "offer"=> GetOffers::collection($offerReplay),
                "count"=> $offerReplay->total(),
            ], $code);
    }


    public function createOffer(Request $request)
    {

        try {
            DB::beginTransaction();
            $product = Product::findOrFail($request->product_id);
            $user_id = Hellper::companyId();

            if ($product->user_id == $user_id){
                DB::rollBack();
                return response()->json(
                    [
                        "status"=> false,
                        "message"=> 'You can\'t leave yourself offer',
                    ], 401);
            }

            $offerReplay = OrderOffer::query()
                ->where('type', $request->type)
                ->where('buyer_id', $user_id)
                ->where('product_id', $request->product_id)
                ->WhereIn('delivery', ['pending', 'rejected'])    // pending for message: Client not approved  // rejected update offer (replay, sent offer again)
                ->first();

            if ($offerReplay) {   //todo update offer
                if ($offerReplay->status == 0){ // delivery -> pending
                    DB::rollBack();
                    return response()->json(
                        [
                            "status"=> false,
                            "message"=> 'Client not approved',
                        ], 401);
                }
                if ($request->type == 'offer' && $offerReplay->count_offer >= 3){
                    DB::rollBack();
                    return response()->json(
                        [
                            "status"=> false,
                            "message"=> 'Offer cancelled',
                            "count_offer"=> $offerReplay->count_offer,
                            "user_id"=> $user_id,
                            "data"=> $offerReplay,
                        ], 401);
                }
                $offerReplay->price = $request->price;
                $offerReplay->type =  $request->type;
                $offerReplay->quantity = $request->quantity;
                $offerReplay->address_id = isset($request->address_id) ? $request->address_id : null;
                $offerReplay->message = $request->message;
                $offerReplay->count_offer = $request->type == 'offer' ? $offerReplay->count_offer+1 : $offerReplay->count_offer;
                $offerReplay->shipping = $request->shipping;
                $offerReplay->credit = $request->credit;
                $offerReplay->status = 0;
                $offerReplay->delivery = OrderOffer::typeOfDeliveryOffer(1);
                $offerReplay->save();
//                dd($offerReplay);
                Hellper::userEvent(true, $user_id, $request->type, $offerReplay, "You sent ".$request->type." again");
                Hellper::userEvent(true, $offerReplay->buyer_id, $request->type, $offerReplay, "New ".$request->type);


            }else{   //todo create new offer

                $productUser = Product::findOrFail($request->product_id);
                $offer = new OrderOffer();
                $offer->product_id = $request->product_id;
                $offer->buyer_id = $user_id;
                $offer->seller_id = $productUser->user_id;
                $offer->address_id = isset($request->address_id) ? $request->address_id : null;
                $offer->price = $request->price;
                $offer->type = $request->type;
                $offer->quantity = $request->quantity;
                $offer->credit = $request->credit ? 1 : 0;
                $offer->message = $request->message;
                $offer->shipping = $request->shipping;
                $offer->count_offer = 1;
                $offer->status = 0;
                $offer->delivery = OrderOffer::typeOfDeliveryOffer(1);
                $offer->save();

                Hellper::userEvent(true, $user_id, $request->type, $offer, "You sent ".$request->type);
                Hellper::userEvent(true, $productUser->user_id, $request->type, $offer, "New ".$request->type);

                if ($request->type == 'auction'){
                    ProductAuction::query()->where('product_id', $request->product_id)->where('status_winner', 1)->first()->update(['status_buy' => 1]);
                }
            }

            DB::commit();

            return response()->json(
                [
                    "status"=> true,
                    "message"=> 'Successfully',
                    "count_offer"=> isset($offerReplay->count_offer) ? $offerReplay->count_offer : 1,
                ]);
        }catch (\Exception $error){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'error'=> [
                    'error'=> $error->getMessage(),
                    'errorCode'=> $error->getCode(),
                    'errorFile'=> $error->getFile(),
                    'errorLine'=> $error->getLine(),
                ],
                'code'=> 401,
            ], 401);
        }
    }

    public function offerDeliveryChange(Request $request)
    {
        $offerReplay = OrderOffer::findOrFail($request->offer_id)->load('product');
        $product = $offerReplay->product;
        $user_id = Hellper::companyId();
        try {
            DB::beginTransaction();
                if ($request->success == true || $request->success == '1'){

                    $order = new Order();
                    $order->product_id = $offerReplay->product_id;
                    $order->buyer_id = $offerReplay->buyer_id;
                    $order->seller_id = $offerReplay->seller_id;
                    $order->offer_id = $offerReplay->id;
                    $order->quantity = $offerReplay->quantity;
                    $order->price = $offerReplay->price;
                    $order->original_price = $product->price;
                    $order->type = $offerReplay->type;
                    $order->track_number = null;
                    $order->delivery = Order::typeOfDeliveryOrder(1);
                    $order->history = $offerReplay->message;
                    $order->pdf = null;
                    $order->shipping = $offerReplay->shipping;
                    $order->status = 0;
                    if ($order->save()){
                        $offerReplay->status = 1;
                        $offerReplay->delivery =  OrderOffer::typeOfDeliveryOffer(0);
                        $offerReplay->save();
                    }

                    Hellper::userEvent(true, $user_id, $offerReplay->type, $offerReplay, "Аpproved ".$offerReplay->type);
                    Hellper::userEvent(true, $user_id, 'order', $order, "Order created");

                }else{
                    $offerReplay->status = 1;
                    $offerReplay->delivery =  OrderOffer::typeOfDeliveryOffer(2);
                    $offerReplay->save();
                    Hellper::userEvent(true, $user_id, $offerReplay->type, $offerReplay, "Canceled ".$offerReplay->type);
                }
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully',
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'status' => false,
                'e' => $e->getMessage()
            ];
        }

    }
}
