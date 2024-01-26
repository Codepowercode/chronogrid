<?php


namespace App\Http\Services;


use App\Http\Controllers\Backend\ListingController;
use App\Http\Requests\Api\Product\EditRequest;
use App\Http\Resources\Listing\ListingWithModelNumberResource;
use App\Http\Resources\Product\AuctionListResource;
use App\Http\Resources\Product\ProductAuctionResource;
use App\Http\Resources\Product\ProductAuctionSalesResource;
use App\Http\Resources\Product\ProductMyAuctionBidResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductsLowPriceResource;
use App\Http\Resources\Product\ProductsResource;
use App\Http\Resources\User\UserResource;
use App\Jobs\CsvJob;
use App\Jobs\ProductEndAuctionJob;
use App\Jobs\ProductStartAuctionJob;
use App\Models\Listing;
use App\Models\Product;
use App\Models\ProductAuction;
use App\Models\ProductError;
use App\Models\ProductImage;
use App\Models\User;
use App\MyHellepr\Hellper;
use App\MyHellepr\PaginateHellper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;
use App\Imports\UsersImport;

class ProductService
{

    public function getProducts($request, $globalSearch = false)
    {
        PaginateHellper::paginatePage();

        $products = Product::query()->GetProductForView(); //scope in model

        if (isset($request['company_id'])){
            $products->where('user_id', $request['company_id']);
        }


        if(isset($request['search']) && $request['search'] != ''){
            $products->where('brand' ,  'like' , '%'. $request['search'] . '%')->orWhere('model_number' ,  'like' , '%'. $request['search'] . '%');
        }
        if(isset($request['model']) && $request['model'] != ''){
            $products->where('model' ,  'like' , '%'. $request['model'] . '%');
        }
        if(isset($request['model_number']) && $request['model_number'] != ''){
            $products->where('model_number' ,  'like' , '%'. $request['model_number'] . '%');
        }
        if(!empty($request['dial'])){
            $products->whereIn('dial_type' ,  $request['dial'] );
        }
        if(!empty($request['bezel_type'])){
            $products->whereIn('bezel_type' ,  $request['bezel_type'] );
        }
        if(!empty($request['band_type'])){
            $products->whereIn('bracelet_type' ,  $request['band_type'] );
        }
        if(isset($request['metal']) && $request['metal'] != ''){
            $products->where('metal' ,  'like' , '%'. $request['metal'] . '%');
        }

//        dd($request);
        if ($globalSearch){
            if(isset($request['brand']) && $request['brand'] != ''){
                $products->where('brand' ,  'like' , '%'. $request['brand'] . '%');
            }
            if(!empty($request['condition'])){
                $products->where('condition' ,   'like' , '%'. $request['condition'] . '%' );
            }
            if(!empty($request['more_condition'])){
                $products->where('more_condition'  , 'like' , '%'. $request['more_condition'] . '%' );
            }
        }else{
            if(isset($request['brand']) && $request['brand'] != ''){
                $products->whereIn('brand' ,  $request['brand']);
            }
            if(isset($request['size']) && $request['size'] != ''){
                $products->whereIn('size' ,  $request['size']);
            }
            if(isset($request['band']) && $request['band'] != ''){
                $products->whereIn('band' ,  $request['band']);
            }
            if(!empty($request['condition'])){
                $products->whereIn('condition' ,  $request['condition'] );
            }
            if(!empty($request['more_condition'])){
                $products->whereIn('more_condition'  , $request['more_condition'] );
            }
        }

        if((isset($request['price'][0]) && $request['price'][0] != '') && (isset($request['price'][1]) && $request['price'][1] != '')){
            $products->whereBetween('price', [$request['price'][0], $request['price'][1]]);
        }elseif(isset($request['price'][0]) && $request['price'][0] != ''){
            $products->where('price'  ,'>=', $request['price'][0] );
        }elseif (isset($request['price'][1]) && $request['price'][1] != ''){
            $products->where('price'  ,  '<=',  $request['price'][1]);
        }

        if((isset($request['year'][0]) && $request['year'][0] != '') && (isset($request['year'][1]) && $request['year'][1] != '')){
            $products->whereBetween('year', [$request['year'][0], $request['year'][1]]);
        }elseif(isset($request['year'][0]) && $request['year'][0] != ''){
            $products->where('year'  ,'>=', $request['year'][0] );
        }elseif (isset($request['year'][1]) && $request['year'][1] != ''){
            $products->where('year'  ,  '<=',  $request['year'][1]);
        }


        if (isset($request['pages']) && $request['pages'] != ''){
            $page = $request['pages'];
        }else{
            $page = 9;
        }
        $data = $products->orderBy('id', 'desc')->paginate($page); // paginate with helper PaginateHellper
        return [
            'products' => ProductsResource::collection($data),
            'count' => $data->total(),
        ];

    }

    public function getProductFilterType($request)
    {
        $product = Product::query()->where('auction', 0);
        // dd($request);
        if(!empty($request)){
            $product = $product->whereIn('brand', [$request]);
        }

        $productYearMax = $product
            ->where('year', '>', 0)
            ->pluck('year')
            ->max();
        $productYearMin = $product
            ->where('year', '>', 0)
            ->pluck('year')
            ->min();
        $productPriceMax = $product
            ->where('price', '>', 0)
            ->pluck('price')
            ->max();
        $productPriceMin = $product
            ->where('price', '>', 0)
            ->pluck('price')
            ->min();

        // $productYearMax = Product::query()
        //     ->where('auction', 0)
        //     ->where('year', '>', 0)
        //     ->pluck('year')
        //     ->max();
        // $productYearMin = Product::query()
        //     ->where('auction', 0)
        //     ->where('year', '>', 0)
        //     ->pluck('year')
        //     ->min();
        // $productPriceMax = Product::query()
        //     ->where('auction', 0)
        //     ->where('price', '>', 0)
        //     ->pluck('price')
        //     ->max();
        // $productPriceMin = Product::query()
        //     ->where('auction', 0)
        //     ->where('price', '>', 0)
        //     ->pluck('price')
        //     ->min();


        $productBrand = $product->distinct()->pluck('brand');
        $productModel = $product->distinct()->pluck('model');
        $productSize = $product->distinct()->pluck('size');
        $productBezelType = $product->distinct()->pluck('bezel_type');
        $productDial = $product->distinct()->pluck('dial_type');
        $productBand = $product->distinct()->pluck('band');

        $data = [
            // 'year' => [
            //     'max'=>$productYearMax,
            //     'min'=>$productYearMin,
            // ],
            'price' => [
                'max'=>$productPriceMax,
                'min'=>$productPriceMin,
            ],
            'brand' => $productBrand,
            'condition' => Product::condition(),
            'model' => $productModel,

            'size' => $productSize,
            'bezel' => $productBezelType,
            'dial' => $productDial,
            'band' => $productBand,
            // 'more_condition' => Product::moreCondition(),
        ];
    //    dd($data);
        return $data;
    }

    public function getSelectInCreateProduct()
    {
        $brand = Listing::query()->distinct()->pluck('brand')->toArray();
        $dialType = Listing::query()->distinct()->pluck('dial_markers')->toArray();
        $dialColor = Listing::query()->distinct()->pluck('dial')->toArray();
        return [
            'status' => true,
            'brand' => $brand,
            'dial_type' => $dialType,
            'dial_color' => $dialColor,
            'duration_time' => [
                'testDurationTime1',
                'testDurationTime2',
                'testDurationTime3',
            ],
            'condition' => [
                'new',
                'used',
            ],
            'more_condition' => Product::moreCondition(),
        ];
    }

    public function getListWithModelNumber($request)
    {
        $list = Listing::query()->where('description', $request['model'])->get();

        return [
            'list' => ListingWithModelNumberResource::collection($list),
//            'list' => $list,
            ];
    }

    public function getCheckProductSerialNumber($serial)
    {
        $serialNumber = Product::query()->where('serial_number', $serial)->count();

        if ($serialNumber){
            $status = false;
            $code = 500;
        }else{
            $status = true;
            $code = 200;
        }

        return [
            'status' => $status,
            'serial_number_count' => $serialNumber,
            'code' => $code
        ];
    }


    public function create($request, $userId)
    {
        try {
            DB::beginTransaction();

            $product = new Product();
            $product->user_id = $userId;
            $product->brand = $request['brand'];
            $product->serial_number = $request['serial_number'];
            $product->description = $request['description'];
            $product->model = $request['model'];
            $product->model_number = $request['model_number'];
            $product->color = $request['color'];
            $product->size = $request['size'];
            $product->metal = $request['metal'];
            $product->bezel_size = isset($request['bezel_size']) ? $request['bezel_size'] : ' ';
            $product->bezel_type = $request['bezel_type'];
            $product->bezel_metal = isset($request['bezel_metal']) ? $request['bezel_metal'] : ' ';
            $product->bracelet_type = isset($request['bracelet_type']) ? $request['bracelet_type'] : '';
            $product->band = isset($request['band']) ? $request['band'] : null;
            $product->condition = $request['condition'];
//            $product->more_condition = $request['condition'] == Product::condition()[0] ? $request['more_condition'] : Product::moreCondition()[2];
            $product->more_condition = $request['more_condition'];
            $product->dial_type = $request['dial_type'];
            $product->note = isset($request['notes']) ? $request['notes'] : null ;
            $product->price = $request['price'];
            $product->min_offer_price = $request['min_offer_price'];
            $product->year = $request['year'];
            $product->shipping = $request['shipping'];
            $product->excel = 0;
            $product->status_position = 'approved';
            $product->quantity = $request['quantity'];
            $product->auction = $request['auction'];
            if($request['auction'] == 1){
                $product->auction_price = $request['price'];
                $product->auction_min_bid = $request['auction_min_bid'];
                $product->auction_start = \Carbon\Carbon::parse($request['auction_start']);
                $product->auction_end = \Carbon\Carbon::parse($request['auction_end']);
            }

            if ($product->save()){

//                dd($product->auction_start ,Carbon::now(), Carbon::now()->addSeconds(10));

                if ($product->auction && $product->auction_start > Carbon::now()){
                    $product->update(['status' => 0 ]);
//                    dispatch(new ProductStartAuctionJob($product->id))->delay(Carbon::now()->addSeconds(5));
                    dispatch(new ProductStartAuctionJob($product->id))->delay($product->auction_start);

                }

                if ($product->auction){
//                    dispatch(new ProductEndAuctionJob($product->id))->delay(Carbon::now()->addSeconds(10));
                    dispatch(new ProductEndAuctionJob($product->id))->delay($product->auction_end); //todo pakel em vor ashxati 09.03.2023
                }

//                dd(__METHOD__, "end");

//                $image = $request['images'];
                foreach ($request['images'] as $image){

//                    $productImage = new ProductImage();
//                    $productImage->product_id = $product->id;
//                    $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR );
//                    $fileName =  Hellper::upload($image, $path);
//                    $imagePath = "/storage/product/" . $fileName;
//                    $productImage->path = $imagePath;
//                    $productImage->save();

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $fileName =  Hellper::base64($image, 'product', 'image');
                    $productImage->path = $fileName;

                    $productImage->save();
                }
            }
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully',
                'product' => $product,
                'code' => 200
            ];
        } catch (\Throwable $error) {
            DB::rollBack();
            return [
                'status' => false,
//                'message' => $e->getPrevious()->errorInfo[2] && $e->getTrace()[0]['args'][1][19] ? 'Error: '.$e->getPrevious()->errorInfo[2].'| Message: Model Number in excel file '. $e->getTrace()[0]['args'][1][19] : 'oops error',
                'error'=> [
                    'error'=> $error->getMessage(),
                    'errorCode'=> $error->getCode(),
                    'errorFile'=> $error->getFile(),
                    'errorLine'=> $error->getLine(),
                ],
                'code' => 500,
            ];
        }
    }

    public function getProductById($id)
    {
        $productById = Product::findOrFail($id)->load(['auctionHistory' => function($q){
            $q->where('user_id', Hellper::companyId());
        }]);

        $user = User::query()->where('id', $productById->user_id)->with('ratingCompany')->first();
            $count = $user->ratingCompany->count();
            $feed_back = $user->ratingCompany->map(function ($q){
                $out = [
                    'user_name' => User::findOrFail($q->user_id)->name,
                    'feed_back' => $q->feed_back,
                ];
                return $out;
            })->toArray();

            if (isset($user->ratingCompany->ratingCompany)){
                $rating_payment_process = $user->ratingCompany->sum('rating_payment_process') / $count;
                $rating_overall_experience = $user->ratingCompany->sum('rating_overall_experience') / $count;
                $rating_communication = $user->ratingCompany->sum('rating_communication') / $count;
            }

           $output = [
               'count' => $count,
               'feed_back' => $feed_back,
               'rating_payment_process' => isset($rating_payment_process) ? $rating_payment_process : 0,
               'rating_overall_experience' => isset($rating_overall_experience) ? $rating_overall_experience : 0,
               'rating_communication' => isset($rating_communication) ? $rating_communication : 0,
               'company' => new UserResource($user),
           ];


//        $lowPrice = Product::where('status', 1)->where('model_number', $productById->model_number)->orderBy('price', 'ASC')->get();

//        dd($output);

        return [
            'product' => new ProductResource($productById),
//            'low_price' => ProductsResource::collection($lowPrice),
            'seller' => $output,
            'shipping' => $productById->shipping,
            'auction_history' => $productById->auctionHistory,
            'description' => 'test',
        ];
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $productLists = Listing::query()->where('description',  $request['model_number'])->count();
            if ($productLists){
                $status_position = Product::settingsFilter()[1];
            }else{
                $status_position = Product::settingsFilter()[0];
            }


            $product = Product::findOrFail($id)->load('images');
            $product->brand = $request['brand'];
            $product->description = $request['description'];
            $product->model_number = $request['model_number'];
            $product->model = $request['model'];
            $product->color = $request['color'];
            $product->size = $request['size'];
            $product->metal = $request['metal'];
            $product->bezel_size = $request['bezel_size'];
            $product->bezel_type = $request['bezel_type'];
            $product->bezel_metal = $request['bezel_metal'];
            $product->bracelet_type = $request['bracelet_type'];
            $product->band = $request['band'];
            $product->condition = $request['condition'];
            $product->more_condition = $request['condition'] == Product::condition()[0] ? $request['more_condition'] : Product::moreCondition()[2];
            $product->dial_type = $request['dial_type'];
            $product->note = $request['note'];
            $product->price = $request['price'];
            $product->min_offer_price = $request['min_offer_price'];
            $product->year = $request['year'];
            $product->shipping = $request['shipping'];
            $product->status_position = $status_position;
            $product->quantity = $request['quantity'];
            $product->auction = $request['auction'];
            if($request['auction'] == 1){
                $product->auction_price = $request['price'];
                $product->auction_min_bid = $request['auction_min_bid'];
                $product->auction_start = $request['auction_start'];
                $product->auction_end = $request['auction_end'];
            }else{
                $product->auction_price = null;
                $product->auction_min_bid = null;
                $product->auction_start = null;
                $product->auction_end = null;
            }
//            dd($product, $request);
            if ($product->save()){
                if (!empty($request['images'])){
                    foreach ($request['images'] as $image){
//                        $productImage = new ProductImage();
//                        $productImage->product_id = $product->id;
//                        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR );
//                        $fileName =  Hellper::upload($image, $path);
//                        $imagePath = "/storage/product/" . $fileName;
//                        $productImage->path = $imagePath;
//                        $productImage->save();

                        $productImage = new ProductImage();
                        $productImage->product_id = $product->id;
                        $fileName =  Hellper::base64($image, 'product', 'image');
                        $productImage->path = $fileName;
                        $productImage->save();
                    }
                }
            }
            DB::commit();

            return [
                'status' => true,
                'message' => 'Successfully',
                'product' => $product,
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'status' => false,
                'e' => $e->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id)->load('images');
        try {
            DB::beginTransaction();

            foreach ($product->images as $item) {
                $productImage = str_replace('/storage', '', $item->path);
                Storage::delete('/public' . $productImage);
            }
            $product->delete();

            DB::commit();
            return [
                'status' => true,
                'message' => 'Successfully deleted',
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'status' => false,
                'e' => $e->getMessage()
            ];
        }
    }

    public function deleteOneImage($id)
    {

        $productImage = ProductImage::findOrFail($id);
        $productImages = ProductImage::where('product_id', $productImage->product_id)->count();
        if ($productImages == 1){
            return [
                'status' => false,
                'message' => 'You don`t can delete last image',
            ];
        }
        try {
            DB::beginTransaction();

            $productOneImage = str_replace('/storage', '', $productImage->path);
            Storage::delete('/public' . $productOneImage);

            $productImage->delete();

            DB::commit();
            return [
                'status' => true,
                'message' => 'Successfully deleted',
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                'status' => false,
                'e' => $e->getMessage()
            ];
        }
    }

    public function getAuctionBuySales($type)
    {
        $user = Hellper::apiAuth(true);
        if ($type == 'buy'){
            $auction = $user->load('auction')->auction->pluck('product_id')->toArray();
            $product = Product::query()->whereIn('id', $auction)->with(['auctionHistory' => function($q) use($user){
                $q->where('user_id', $user->id);
            }])->where('auction_status_finish', 0)->paginate(10);
            return
                [
                    'products' => ProductMyAuctionBidResource::collection($product),
                    'count' => $product->total()
                ];
        }else if ($type == 'sales'){
            $product = Product::query()->where('user_id', $user->id)->where('auction', 1)->with(['auctionHistory'])->paginate(10);
            return
                [
                    'products' => ProductAuctionSalesResource::collection($product),
                    'count' => $product->total()
                ];
        }

    }


    public function getAuctionHistory($product_id)
    {
        $auction = ProductAuction::where('product_id', $product_id)->with('company', 'product')->get();
        return ProductAuctionResource::collection($auction);
    }


    public function getMyAuctionHistory($user) // dont used
    {

        $auction = $user->load('auction')->auction->pluck('product_id')->toArray();
        $product = Product::query()->whereIn('id', $auction)->with(['auctionHistory' => function($q) use($user){
            $q->where('user_id', $user->id);
        }])->get();
        return ProductMyAuctionBidResource::collection($product);
    }

    public function getWinAuctionHistory($user)
    {
        $auctionWin = ProductAuction::query()->where('user_id', $user->id)->where('status_buy', 0)->where('status_winner', 1)->pluck('product_id')->toArray() ;
        $product = Product::query()->whereIn('id', $auctionWin)->with(['auctionHistory' => function($q) use($user){
            $q->where('user_id', $user->id);
        }])->paginate(10);
        return [
            'product' => ProductMyAuctionBidResource::collection($product),
            'count' => $product->total(),
        ];
    }


    public function getAuctionList($request)
    {
//        dd($request);
        isset($request['recently']) && (int)$request['recently'] ? $recently = $request['recently'] : $recently = 9;
        isset($request['ending_soon']) && (int)$request['ending_soon'] ? $ending_soon = $request['ending_soon'] : $ending_soon = 9;


//        $auction_recently = Product::with('company', 'images', 'auctionHistory')
//            ->where('status', 1)
//            ->where('auction', 1)
//            ->where('auction_start', '<', Carbon::now())
//            ->where('auction_end', '>', Carbon::now())
//            ->orderBy('created_at', 'DESC')
//            ->paginate($recently);
//
//        $auction_ending_soon = Product::with('company', 'images', 'auctionHistory')
//            ->where('status', 1)
//            ->where('auction', 1)
//            ->where('auction_start', '<', Carbon::now())
//            ->where('auction_end', '>', Carbon::now())
//            ->orderBy('auction_end')
//            ->paginate($ending_soon);


        $auction = Product::with('company', 'images', 'auctionHistory');
        $auction = $auction->where('status', 1);
        $auction = $auction->where('auction', 1);
        $auction = $auction->where('auction_start', '<', Carbon::now());
        $auction = $auction->where('auction_end', '>', Carbon::now());
        if(isset($request['search'])){
        $auction = $auction->where('brand',  'like' , '%'. $request['search'] . '%');
    }
        $auction_recently = $auction->orderBy('created_at', 'DESC')->paginate($recently);
        $auction_ending_soon = $auction->orderBy('auction_end')->paginate($ending_soon);


//        dd(Carbon::now());
        return [
            'auction_ending_soon' => [
                'auction' => AuctionListResource::collection($auction_ending_soon),
                'count' => $auction_ending_soon->total(),
                'page_count' => $ending_soon,
            ],
            'auction_recently' => [
                'auction' => AuctionListResource::collection($auction_recently),
                'count' => $auction_recently->total(),
                'page_count' => $recently,
            ],
        ];
    }

    public function auctionHistoryCreate($request, $authUser)
    {
        $product = Product::findOrFail($request['product_id']);



        if ($product->auction === 0){
            return [
                'status' => false,
                'message' => 'This product does not participate in the auction',
                'code' => 400,
            ];
        }
        if ($product->user_id === $authUser){
            return [
                'status' => false,
                'message' => 'You cannot participate in your auction',
                'code' => 400,
            ];
        }
        if ($product->auction_end < date('Y-m-d H:m:s',time())){
            return [
                'status' => false,
                'message' => 'Auction finished',
                'code' => 400,
            ];
        }
        if (isset($product->auction_min_bid) && ($product->auction_price + $product->auction_min_bid) > $request['price']){
            return [
                'status' => false,
                'message' => 'Minimum bid '.($product->auction_price + $product->auction_min_bid),
                'code' => 400,
            ];
        }
        if ($product->auction_price != null && $product->auction_price > $request['price']){
            return [
                'status' => false,
                'message' => 'Please offer higher amount than the current one',
                'code' => 400,
            ];
        }

//        dd($authUser);
        try {
            DB::beginTransaction();

            $auction = new ProductAuction();
            $auction->user_id = $authUser;
            $auction->product_id = $request['product_id'];
            $auction->price = $request['price'];
            $auction->status = $request['status'];
            if ($auction->save()){
                $product->auction_price = $request['price'];
                $product->save();
            }

            Hellper::userEvent(true, $authUser, 'bid', $auction, "Your auction bid $".$request['price']);
            Hellper::userEvent(true, $product->user_id, 'bid', $auction, "New auction bid $".$request['price']);


            DB::commit();
            return [
                'status' => true,
                'message' => 'Successfully',
                'auction' => $auction,
                'code' => 200,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => false,
                'e' => $e->getMessage(),
                'code' => 400,
            ];
        }
    }

    public function createCSV($request, $authUser) // todo in front
    {

//        $file_path_array = array_map('str_getcsv', file(public_path('assets/Chronogrid2.csv'))); // open csv
//        $file_path_array = Excel::toArray('test', public_path('assets/ChronogridDataV1.xlsx')); // open xlsx

//        dd($request, $authUser);

        $file = '';
        try {
            DB::beginTransaction();
            if (isset($request['import_file'])){
                // upload and save file -> output = file path
                $path = public_path('csv'.DIRECTORY_SEPARATOR.'csv_file'.DIRECTORY_SEPARATOR);
                $ss =  Hellper::upload($request['import_file'], $path);
                $file = "csv/csv_file/".$ss;
;
                $fileType = $request['import_file']->getClientOriginalExtension(); // csv, xlsx, xlsm ...
                $data = [
                    0 => "Brand",   // +
                    1 => "Description",   // +
                    2 => "Model",   // +
                    3 => "Size (mm)",   // +
                    4 => "Metal",   // +
                    5 => "Condition",   // +
                    6 => "Box (yes or no)",   // +
                    7 => "Papers (yes or no)",   // +
                    8 => "Year",   // +
                    9 => "Bezel type",   // +
                    10 => "Bezel metal",   // +
                    11 => "Band",   // +
                    12 => "Dial type",   // +
                    13 => "Dial Color",   // +
                    14 => "Price",   // +
                    15 => "Min Offer Price",   // +
                    16 => "Note",   // +
                    17 => "Model number",   // +
                    18 => "Shipping Seller (yes or no)",   // +
                    19 => "Shipping Buyer (yes or no)",   // +
                    20 => "Serial Number",   // +
                    21 => "Image",   // +
                ];


                $file_path_array = Excel::toArray('test', public_path($file));

                // ------------------  validation  ------------------
                if (implode($file_path_array[0][0]) !== implode($data))
                {
                    if (count($file_path_array[0]) != count($data)){
                        File::delete(public_path($file)); //delete file
                        return [
                            'status' => false,
                            'message' => 'You are uploaded the wrong file, columns files is not equal',
                            'err' => [
                                'uploaded' => count($file_path_array[0]),
                                'main' => count($data),
                            ],
                            'code' => 500,
                        ];
                    }

                    foreach ($data as $index => $itemValue){
                        if ($file_path_array[0][$index] != $itemValue){
                            $err[$index]['uploaded'] = $file_path_array[0][$index];
                            $err[$index]['main'] = $itemValue;
                            $err[$index]['line'] = $index+1;
                        }
                    }
                    File::delete(public_path($file)); //delete file
                    return [
                        'status' => false,
                        'message' => 'You are uploaded the wrong file',
                        'err' => array_values($err),
                        'code' => 500,
                    ];
                }
                // ------------------  [END] validation  ------------------

                $data = [];


                // ------------------  creating functionality  ------------------
//                foreach ($file_path_array as $item){
                    foreach ($file_path_array[0] as $key => $value){
                        if ($key > 0) {
                            $productLists = Listing::query()->where('description',  $value[17])->count();
                            $productSerialNumber = Product::query()->where('serial_number', $value[20])->count();
                            $blockedProduct = 1;
                            $statusPositionProduct = 'approved';
                            if ($productSerialNumber || $productLists == 0  || !empty(array_values(array_filter($value, fn ($valuee) => is_null($valuee))))){
                                $blockedProduct = 0;
                                $statusPositionProduct = 'waiting';
                            }


                            $seller = $value[18] == 'yes' ? 'seller' : null;
                            $buyer = $value[19] == 'yes' ? 'buyer' : null;
                            if (is_numeric($value[15])){
                                $min_offer = $value[14] > 100 ? $value[14]-100 : $value[14];
                            }else{
                                $min_offer = 0;
                                $blockedProduct = 0;
                                $statusPositionProduct = 'waiting';
                            }
                            $shipping = $seller && $buyer ? 'seller_buyer' : $seller.$buyer;

                                $product = new Product();
                                $product->user_id = $authUser;
                                $product->brand = $value[0] ?? '';
                                $product->description = $value[1] ?? '';
                                $product->model = $value[2] ?? '';
                                $product->size = $value[3] ?? '';
                                $product->metal = $value[4] ?? '';
                                $product->condition = $value[5] ?? '';
                                $product->more_condition = Product::moreCondition(null, true)[$value[6].'_'.$value[7]] ?? '';
                                $product->year = $value[8] ?? '';
                                $product->bezel_size = '';
                                $product->bezel_type = $value[9] ?? '';
                                $product->bezel_metal = $value[10] ?? '';
                                $product->bracelet_type = '';
                                $product->band = $value[11] ?? '';
                                $product->dial_type = $value[12] ?? '';
                                $product->color = $value[13] ?? '';
                                $product->price = $value[14] ?? '';
                                $product->min_offer_price = isset($value[15]) ? $value[15] : $min_offer;
                                $product->quantity = 1;
                                $product->excel = 1;
                                $product->note = isset($value[16]) ? $value[16] : null;
                                $product->model_number = $value[17] ?? '';
                                $product->shipping = $shipping ?? '';
                                $product->status = $blockedProduct;
                                $product->blocked_product = $blockedProduct;
                                $product->status_position = $statusPositionProduct;
                                $product->serial_number = $value[20];
                                $product->save();

                                if (isset($value[21]) && filter_var($value[21], FILTER_VALIDATE_URL) ){
                                    $imageExcel = 'public/'. Hellper::uploadUrlAndSave($value[21], $authUser); //todo path@ choraca
                                }
                                elseif (isset($value[21])){
                                    $imageExcel = 'public/storage/users/'.$authUser.'/product/zip/'.$value[21];
                                }else{
                                    $imageExcel = '/assets/custom/img/default-img.png';
                                }

                                $productImage = new ProductImage();
                                $productImage->product_id = $product->id;
                                $productImage->path = $imageExcel;
                                $productImage->save();

                                if ($product->status){
                                    $data['failed'][$key] = $product->id;
                                }else{
                                    $data['success'][$key] = $product->id;
                                }

                        }
                    }
                }
//            }


            // zip file
            if (isset($request['import_file_zip'])){
                $zip = new ListingController();
                $zip->zip($request, "app/public/users/".$authUser."/product/zip/");

            }

            DB::commit();

            File::delete(public_path($file)); //delete file
            return [
                'status' => true,
                'data' =>  $data,
                'message' => 'successfully',
                'code' => 200,
            ];

        } catch (\Throwable $e) {
            DB::rollBack();


            if(File::exists(public_path($file))){
                File::delete(public_path($file)); //delete file
            }

            return [
                'status' => false,
                'message' => $e->getPrevious()->errorInfo[2] && $e->getTrace()[0]['args'][1][19] ? 'Error: '.$e->getPrevious()->errorInfo[2].'| Message: Model Number in excel file '. $e->getTrace()[0]['args'][1][19] : 'oops error',
                'm' => $e->getMessage(),
                'p' => $e->getPrevious(),
                'code' => 500,
            ];
        }
    }

    public static function productListCSV($request) // todo with admin panel
    {

        try {
            DB::beginTransaction();

            $file_path_array = \Excel::toArray('test', $request['import_file']);


            foreach ($file_path_array as $item){
                foreach ($item as $key => $value){
                    //dd($value);
                    if ($key > 0){
                        if (isset($value[17]) && filter_var($value[17], FILTER_VALIDATE_URL) ){
                            $imageExcel = 'public/'. Hellper::uploadUrlAndSave($value[17], Hellper::apiAuth()->id); //todo path@ choraca
                        }
                        elseif (isset($value[17])){
                            $imageExcel = '/public/storage/unzip/'.$value[17];
                        }else{
                            $imageExcel = '/public/assets/custom/img/default-img.png';
                        }
//                        json_encode();
                        $list = Listing::query()->create([
                            'brand' => $value[0],                // + brand    0        0
                            'model' => $value[1],                // + model    1        2
                            'metal' => $value[2],                // + metal    2        6
                            'description' => $value[3],          // + description ( model_number )
                            'description1' => $value[4],
                            'full_description' => $value[7],
                            'model_text' => $value[5],
                            'model_description' => $value[6],
                            'size' => $value[8],                 // + size   8           5
                            'bezel_material' => $value[9],       // + bezel_metal 9      12
                            'bezel_type' => $value[10],          // +  bezel_type  10    11
                            'bezel_size' => $value[15],
                            'band_material' => $value[11],
                            'band_type' => $value[12],
                            'dial' => $value[13],
                            'dial_markers' => $value[14],
                            'retail' => $value[16],
                            'path' => $imageExcel,
                            'hash' => md5($value[0].$value[1].$value[2].$value[8].$value[9].$value[10]),
                            'json' => json_encode(['brand' => $value[0],'model' => $value[1],'metal' => $value[2],'size' => $value[8],'bezel_material' => $value[9],'bezel_type' => $value[10]]),
//                            'year' => $value[],
                        ]);
                    }
                }
            }

            DB::commit();
            return [
                'status' => true,
                'message' => 'Successfully',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => false,
                'e' => $e->getMessage()
            ];
        }
    }




}
