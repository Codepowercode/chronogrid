<?php

namespace App\Http\Controllers\Api;

use App\Exports\InvoicesExport;
use App\Exports\ProductsExport;
use App\Exports\PurchaseProductsExport;
use App\Exports\SalesProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\Buy\BuyerInfoResource;
use App\Http\Resources\Buy\ProductInfoResource;
use App\Http\Resources\Order\Offer\GetOffers;
use App\Http\Resources\Order\PurchasesHistory;
use App\Http\Resources\Order\SalesHistoryAuction;
use App\Http\Resources\Order\SalesHistoryMarcetpalce;
use App\Http\Resources\Product\CompanyAuctionBiddedListResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Order;
use App\Models\OrderOffer;
use App\Models\Product;
use App\Models\ProductAuction;
use App\Models\User;
use App\Models\UserEvanet;
use App\Models\UserRating;
use App\MyHellepr\Hellper;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            DB::beginTransaction();


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'code'=> 200,
            ], 200);
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

    public function addOrderTrackNumber(Request $request)
    {
        try {
            DB::beginTransaction();
                $order = Order::findOrFail($request->order_id);
                if ($order->seller_id != Hellper::companyId()){
                    return response()->json(
                        [
                            "status"=> false,
                            "message"=> 'You cannot add track number',
                        ]);
                }
                $order->track_number = $request->track_number;
                $order->save();
            DB::commit();
            return response()->json([
                'status' => true,
                "message"=> 'Track number added',
                'code'=> 200,
            ], 200);
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

    public function addOrderLabelShipping(Request $request)
    {
        try {
            DB::beginTransaction();
            $order = Order::findOrFail($request->order_id);

            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'order' . DIRECTORY_SEPARATOR );
            $fileName =  Hellper::upload($request->label_shipping_file, $path);
            $filePath = "/storage/order/" . $fileName;
            $order->pdf = $filePath;
            $order->save();
            DB::commit();
            return response()->json([
                'status' => true,
                "message"=> 'label added',
                'code'=> 200,
            ], 200);
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


    public function getBuyStepOneInfo($product_id)
    {
        try {
            DB::beginTransaction();
                $product = Product::findOrFail($product_id);
            DB::commit();
            return response()->json([
                'status' => true,
                'product' => new ProductInfoResource($product),
                'buyer' => new BuyerInfoResource(Hellper::apiAuth(true)),
                'code'=> 200,
            ], 200);
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


    public function changeTransferStatusOrder(Request $request)
    {
        try {
            DB::beginTransaction();
                if (in_array($request->transfer_status, Order::transferStatusOrder())){
                    $order = Order::findOrFail($request->order_id);
                    $order->transfer_status = $request->transfer_status;
                    $order->save();

                    if ($order->buyer_id == Hellper::companyId()){
                        $user_id = $order->seller_id;
                    }else{
                        $user_id = $order->buyer_id;
                    }

                    $status = null;
                    if ($request->transfer_status ==  Order::transferStatusOrder()[2]){
                        $status = 0;
                    }


                    Hellper::userEvent(true, Hellper::companyId(), UserEvanet::eventType()[0], $order, "You changed the Transfer Status ".$request->transfer_status, null, null, 0, $status );
                    Hellper::userEvent(true, $user_id, UserEvanet::eventType()[0], $order, "Transfer Status changed in ".$request->transfer_status, null, null, 0, $status);
                }else {
                    throw new \Exception("Тhis status does not exist");
                }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'code'=> 200,
            ], 200);
        }catch (\Exception $error){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'error'=> [
                    'message'=> $error->getMessage(),
                    'code'=> $error->getCode(),
                    'file'=> $error->getFile(),
                    'line'=> $error->getLine(),
                ],
                'code'=> 401,
            ], 401);
        }
    }



// todo __________________________________________ 1. Company buy product purchases (list) покупка ___________________________________________________
    public function buyPurchaseCompanyOrdersList()
    {
        $company_id = Hellper::companyId();

        $orders = Order::with('product')->where('buyer_id', $company_id)->whereIn('delivery', ['pending','shipped','approved'])->get();

        $output = PurchasesHistory::collection($orders);

        return response()->json(
            [
                "status"=> true,
                "orders"=> $output,
            ]);
    }

    public function buyPurchaseCompanyOrdersListFilter($delivery)
    {
        $company_id = Hellper::companyId();
        if ($delivery == 'all'){
            $orders = Order::with('product')->where('buyer_id', $company_id);
            $orderOffers = OrderOffer::with('product')
                ->where('type', 'buy_now')
                ->where('delivery', 'pending')
                ->where('buyer_id', $company_id)
                ->orderBy('updated_at', 'DESC');
        }else{
            $orders = Order::with('product')->where('buyer_id', $company_id)->where('delivery', $delivery);
            $orderOffers = OrderOffer::with('product')
                ->where('type', 'buy_now')
                ->where('delivery', 'pending')
                ->where('buyer_id', $company_id)
                ->orderBy('updated_at', 'DESC');
        }

        $orders = $orders->paginate(10);
        $orderOffers = $orderOffers->paginate(10);
        $output = PurchasesHistory::collection($orders);
        $outputOffers = GetOffers::collection($orderOffers);

        return response()->json(
            [
                "status"=> true,
                "paginate"=> 10,
                "orders"=> $output,
                "waiting"=> $outputOffers,
                "count" => $orders->total(),
            ]);
    }

    public function buyPurchaseCompanyOrdersListHistory()
    {
//        dd(12313213);
        $company_id = Hellper::companyId();
        $orders = Order::query()->with(['product'])->where('buyer_id', $company_id)->orderBy('id', 'DESC')->get();

        $output = PurchasesHistory::collection($orders);

        return response()->json(
            [
                "status"=> true,
                "purchases_history" => $output,
                "count" => $orders->count(),
            ]);
    }

    public function purchaseChangeStatus(Request $request, $status)
    {
        try {
            DB::beginTransaction();

//            $status_id = array_search($status , );
                if (in_array($status, Order::typeOfDeliveryOrder())){
                    $orders = Order::findOrFail($request->order_id)->load('product');
                    $orders->delivery = $status;
                    $orders->save();

                    Hellper::userEvent(true, Hellper::companyId(), 'order', $orders, "Status Changed ".$status, null);

                }else{
                    DB::rollBack();
                    throw new \Exception("Тhis status does not exist");
                }
            DB::commit();
            return response()->json([
                'status' => true,
                "orders"=> new PurchasesHistory($orders),
                'code'=> 200,
            ], 200);
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

    public function purchaseLeaveReview(Request $request)
    {
        try {
            DB::beginTransaction();
                $order = Order::query()->findOrFail($request->product_id); // product_id = order_id { mistake }
                $product = Product::query()->findOrFail($order->product_id);
                $company_id = $product->user_id;
                $user_id = Hellper::companyId();

                $rating = new UserRating();
                $rating->user_id = $user_id;
                $rating->company_id = $company_id;
                $rating->rating_payment_process = $request->rating_payment_process;
                $rating->rating_overall_experience = $request->rating_overall_experience;
                $rating->rating_communication = $request->rating_communication;
                $rating->feed_back = $request->feed_back;
                $rating->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'code'=> 200,
            ], 200);
        }catch (\Exception $error){
            DB::rollBack();
            return response()->json([
                'product_id' => $request->product_id,
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

// todo __________________________________________ 2. order in pending sales (list) продажи ___________________________________________________
    public function buySalesCompanyOrdersList()
    {
        $company_id = Hellper::companyId();

        $orders = Order::with('product')->where('seller_id', $company_id)->whereIn('delivery', ['pending','shipped','approved'])->get();

        return response()->json(
            [
                "status"=> true,
                "orders"=> $orders,
            ]);
    }

    public function buySalesCompanyOrdersListHistory($type)
    {

        try {
            DB::beginTransaction();
//                $auction = $type === 'auction' ? 1 : 0;
                $auction = 0;

                $company_id = Hellper::companyId();
    //        dd($company_id);
                $orders = Order::query()->with(['product' => function($q){
                    $q->with('auctionHistory');
                }])->where('seller_id', $company_id)->where('auction', $auction)->orderBy('id', 'DESC')->get();

            $orderOffers = OrderOffer::with('product')
                ->where('type', 'buy_now')
                ->where('delivery', 'pending')
                ->where('seller_id', $company_id)
                ->orderBy('updated_at', 'DESC')
                ->get();


//            $type === 'auction' ? $output = SalesHistoryAuction::collection($orders) : $output = SalesHistoryMarcetpalce::collection($orders);
            $output = SalesHistoryMarcetpalce::collection($orders);
            DB::commit();
            return response()->json([
                'status' => true,
                "sales_history" => $output,
                "waiting" =>  GetOffers::collection($orderOffers),
                "user" =>  Hellper::companyId(),
                'code'=> 200,
            ], 200);
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


// todo __________________________________________ 1. orders Cancel ___________________________________________________

    public function ordersCancel($id)
    {
        try {
            DB::beginTransaction();
                $company_id = Hellper::companyId();
                $order = Order::findOrFail($id);


                if (Carbon::parse($order->created_at)->addHours(24) < Carbon::now()){
                    return response()->json(
                        [
                            "status"=> false,
                            "message"=> 'You cannot cancel the order',
                        ]);
                }

                $order->status = 1;
                $order->canceled_user_id = $company_id;
                $order->delivery = Order::typeOfDeliveryOrder(0);  //cancelled
                $order->save();
            DB::commit();
            return response()->json([
                'status' => true,
                "message"=> 'Order cancelled',
                'code'=> 200,
            ], 200);
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

    public function getOrderStatus()
    {
        $order_status = Order::typeOfDeliveryOrder(); //all

        return response()->json(
            [
                "status"=> false,
                "order_status"=> $order_status,
            ]);
    }

    public function changeOrderStatusDelivery(Request $request)
    {
        try {
            DB::beginTransaction();
                $order = Order::findOrFail($request->order_id);

                if (Carbon::parse($order->created_at)->addHours(24) < Carbon::now()){
                    return response()->json(
                        [
                            "status"=> false,
                            "message"=> 'You cannot change the order status',
                        ]);
                }

                $order->status = 1;
                $order->delivery = Order::typeOfDeliveryOrder($request->delivery_id);
                $order->save();

            Hellper::userEvent(true, Hellper::companyId(), 'order', $order, "Status Changed ".Order::typeOfDeliveryOrder($request->delivery_id), null);

            DB::commit();
            return response()->json([
                'status' => true,
                "message"=> 'Order cancelled',
                'code'=> 200,
            ], 200);
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




    public function downloadInvoice($order_id)
    {

        try {
                DB::beginTransaction();
                $order = Order::findOrFail($order_id)->load(
                ['product' => function($product_query){
                    $product_query->with('images');
                }, 'offer' => function($offer_query){
                    $offer_query->with('address');
                }, 'seller'=> function($seller_query){
                    $seller_query->with('sellerInfo', 'sellerAddress');
                }, 'buyer'=> function($buyer_query){
                    $buyer_query->with('buyerInfo', 'buyerAddress');
                }])->toArray();


                if ($order){
                    $pdfs = PDF::loadView('pdf.movie-booking-invoice', $order);
                    $ss =  Hellper::base64(base64_encode($pdfs->output()), 'pdf', 'pdf', $order['seller_id']);

                    $order = Order::findOrFail($order_id);
                    $order->pdf = $ss;
                    $order->save();
                }

            DB::commit();
            // download PDF file with download method
            return $pdfs->download('pdf_file.pdf');
//            return response()->json([
//                'status' => true,
//                'download' => $pdf->download('pdf_file.pdf'),
//                'code'=> 200,
//            ], 200);


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

    public function downloadProduct($history, $user_id)
    {
        //excel working without token
        // https://www.geeksforgeeks.org/laravel-import-export-excel-file/
        // https://docs.laravel-excel.com/3.1/exports/multiple-sheets.html
        if ($history == 'purchase'){
            return Excel::download(new PurchaseProductsExport($user_id), $history.'.xls');
        }elseif ($history == 'sales_all' || $history == 'sales_marketplace' || $history == 'sales_auction'){
            return Excel::download(new SalesProductsExport($user_id, $history), $history.'.xls');
        }
    }


    public function forTeste($delivery)
    {

        $arr = [
            'pending',
            'shipped',
            'approved',
            'didnt_shipped',
        ];

        $rand = [
            'payment_sent',
            'payment_approved',
            'payment_canceled',
        ];


        $orders = Order::all();



// todo ------------------ random
        if ($delivery == 'random'){
            foreach ($orders as $order){
                $order->update([
                    'delivery' => $arr[array_rand($arr)]
                ]);
            }
            return response()->json([
                'message' =>'vsyo sax poxvec :D'
            ],200);
        }



// todo ------------------ pending shipped approved didnt_shipped
        if (in_array($delivery, ['pending', 'shipped' , 'approved', 'didnt_shipped'])){
            foreach ($orders as $order){
                $order->update([
                    'delivery' => $delivery
                ]);
            }
            return response()->json([
                'message' =>'vsyo sax poxvec :D'
            ],200);
        }


// todo ------------------ label_clear
        if ($delivery == 'label_clear'){

            foreach ($orders as $kay => $order){
                if ($kay > 0){
                    $order->update([
                        'pdf' => null
                    ]);
                }
            }
            return response()->json([
                'message' =>'vsyo sax poxvec :D'
            ],200);
        }



// todo ------------------ payment_sent payment_approved payment_canceled
        if (in_array($delivery, ['payment_sent', 'payment_approved', 'payment_canceled'])){

            foreach ($orders as $kay => $order){
                $order->update([
                    'transfer_status' => $delivery
                ]);
            }
            return response()->json([
                'message' =>'vsyo sax poxvec :D'
            ],200);
        }


// todo ------------------ payment_random
        if ($delivery == 'payment_random'){
            foreach ($orders as $order){
                $order->update([
                    'transfer_status' => $rand[array_rand($rand)]
                ]);
            }
            return response()->json([
                'message' =>'vsyo sax poxvec :D'
            ],200);
        }


        return response()->json([
            'url'=>[
                'https://app.chronogrid.com/api/change/all/delivery/shipped',
                'https://app.chronogrid.com/api/change/all/delivery/pending',
                'https://app.chronogrid.com/api/change/all/delivery/approved',
                'https://app.chronogrid.com/api/change/all/delivery/didnt_shipped',
                'https://app.chronogrid.com/api/change/all/delivery/random',
                'https://app.chronogrid.com/api/change/all/delivery/label_clear',
                'https://app.chronogrid.com/api/change/all/delivery/payment_sent',
                'https://app.chronogrid.com/api/change/all/delivery/payment_approved',
                'https://app.chronogrid.com/api/change/all/delivery/payment_canceled',
                'https://app.chronogrid.com/api/change/all/delivery/payment_random',
            ],
            'message' => 'me normal ban gri :D'
        ],401);

    }

}




//try {
//    DB::beginTransaction();
//
//    DB::commit();
//    return response()->json([
//        'status' => true,
//
//        'code'=> 200,
//    ], 200);
//}catch (\Exception $error){
//    DB::rollBack();
//    return response()->json([
//        'status' => false,
//        'error'=> [
//            'error'=> $error->getMessage(),
//            'errorCode'=> $error->getCode(),
//            'errorFile'=> $error->getFile(),
//            'errorLine'=> $error->getLine(),
//        ],
//        'code'=> 401,
//    ], 401);
//}
