<?php


namespace App\Http\Services;


use App\Http\Resources\Listing\ListingResource;
use App\Http\Resources\Listing\ListingsResource;
use App\Http\Resources\Product\ProductsResource;
use App\Models\Listing;
use App\Models\Product;
use App\MyHellepr\Hellper;
use App\MyHellepr\PaginateHellper;
use Illuminate\Pagination\Paginator;

class ListingService
{
    public function getListings($request, $globalSearch = false)
    {
        PaginateHellper::paginatePage();

        if (!empty($request['price']) || !empty($request['condition']) || !empty($request['more_condition'])){
            $products = Product::with('images', 'company')->where('status', 1);
            if((isset($request['price'][0]) && $request['price'][0] != '') && (isset($request['price'][1]) && $request['price'][1] != '')){
                $products->whereBetween('price', [$request['price'][0], $request['price'][1]]);
            }elseif(isset($request['price'][0]) && $request['price'][0] != ''){
                $products->where('price'  ,'>=', $request['price'][0] );
            }elseif (isset($request['price'][1]) && $request['price '][1] != ''){
                $products->where('price'  ,  '<=',  $request['price'][1]);
            }
            if(!empty($request['condition'])){
                $products->whereIn('condition' ,  $request['condition'] );
            }
            if(!empty($request['more_condition'])){
                $products->whereIn('more_condition'  , $request['more_condition'] );
            }
            $product_ids = $products->pluck('model_number');
        }

        $listings = Listing::orderByDesc('created_at');

        if (!empty($product_ids)){
            $listings->whereIn('description'  , $product_ids->toArray() );
        }



        if(isset($request['search']) && $request['search'] != ''){
            $listings->where('brand' ,  'like' , '%'. $request['search'] . '%')->orWhere('description' , 'like' , '%'. $request['search'] . '%');
        }
        if(isset($request['description']) && $request['description'] != ''){  // +++++++++++++
            $listings->where('description' ,  'like' , '%'. $request['description'] . '%');
        }
        if(isset($request['metal']) && $request['metal'] != ''){
            $listings->where('metal' ,  'like' , '%'. $request['metal'] . '%');
        }

        if ($globalSearch){
            if(isset($request['brand']) && $request['brand'] != ''){
                $listings->where('brand' ,  'like' , '%'. $request['brand'] . '%');
            }
            if(isset($request['model']) && $request['model'] != ''){
                $listings->where('model' ,  'like' , '%'. $request['model'] . '%');
            }
            if(isset($request['dial'])  && $request['dial'] != ''){
                $listings->where('dial' ,  $request['dial'] );
            }
            if(isset($request['dial_markers'])  && $request['dial_markers'] != ''){
                $listings->where('dial_markers' , 'like' , '%'. $request['dial_markers']  . '%');
            }
            if(isset($request['bezel_material'])  && $request['bezel_material'] != ''){
                $listings->where('bezel_material' , 'like' , '%'. $request['bezel_material']  . '%');
            }
            if(isset($request['bezel_type'])  && $request['bezel_type'] != ''){
                $listings->where('bezel_type' , 'like' , '%'. $request['bezel_type'] . '%' );
            }
            if(isset($request['band_material'])  && $request['band_material'] != ''){
                $listings->where('band_material' , 'like' , '%'. $request['band_material']  . '%');
            }
            if(isset($request['band_type'])  && $request['band_type'] != ''){
                $listings->where('band_type' , 'like' , '%'. $request['band_type'] . '%' );
            }
        }else{
            if(isset($request['brand']) && $request['brand'] != ''){ 
                $listings->whereIn('brand' , $request['brand'] );
            }
            if(isset($request['model']) && $request['model'] != ''){ 
                $listings->whereIn('model' , $request['model'] );
            }
            if(isset($request['size']) && $request['size'] != ''){ 
                $listings->whereIn('size' , $request['size'] );
            }
            if(!empty($request['bezel_type'])){ 
                $listings->whereIn('bezel_type' ,  $request['bezel_type'] );
            }
            if(!empty($request['dial'])){ 
                $listings->whereIn('dial' ,  $request['dial'] );
            }
            if(!empty($request['band_material'])){
                $listings->whereIn('band_material' ,  $request['band_material'] );
            }



           
            if(!empty($request['dial_markers'])){
                $listings->whereIn('dial_markers' ,  $request['dial_markers'] );
            }
            if(!empty($request['bezel_material'])){
                $listings->whereIn('bezel_material' ,  $request['bezel_material'] );
            }
            if(!empty($request['band_type'])){
                $listings->whereIn('band_type' ,  $request['band_type'] );
            }
        }

        if((isset($request['year'][0]) && $request['year'][0] != '') && (isset($request['year'][1]) && $request['year'][1] != '')){
            $listings->whereBetween('year', [$request['year'][0], $request['year'][1]]);
        }elseif(isset($request['year'][0]) && $request['year'][0] != ''){
            $listings->where('year','>=', $request['year'][0] );
        }elseif (isset($request['year'][1]) && $request['year'][1] != ''){
            $listings->where('year',  '<=',  $request['year'][1]);
        }


        if (isset($request['pages']) && $request['pages'] != ''){
            $page = $request['pages'];
        }else{
            $page = 9;
        }
        $data = $listings->paginate($page); // paginate with helper PaginateHellper
        return [
            'listings'=> ListingsResource::collection($data),
            'count'=> $data->total(),
        ];
    }

    public function getListingFilterType($request)
    {
        $listing = Listing::query();
        $listingBrand = Listing::query();
        if(!empty($request)){
            $listing = $listing->whereIn('brand', $request);
        }

        // $productYearMax = $listing->max('year');
        // $productYearMin = $listing->min('year');
        $listingDial = $listing->distinct()->pluck('dial');
        // $listingDialMarkers = $listing->distinct()->pluck('dial_markers');
        // $listingBezelMaterial = $listing->distinct()->pluck('bezel_material');
        $listingBezelType = $listing->distinct()->pluck('bezel_type');
        $listingBandMaterial = $listing->distinct()->pluck('band_material');
        // $listingBandType = $listing->distinct()->pluck('band_type');
        $listingBrand = $listingBrand->distinct()->pluck('brand');
        $listingModel = $listing->distinct()->pluck('model');
        $listingSize = $listing->distinct()->pluck('size');
        // $productPriceMax = Product::query()->where('price', '>', 0)->pluck('price')->max();
        // $productPriceMin = Product::query()->where('price', '>', 0)->pluck('price')->min();


        $data = [
            // 'year' => [
            //     'max'=>$productYearMax,
            //     'min'=>$productYearMin,
            // ],
            // 'price' => [
            //     'max'=> (int)$productPriceMax,
            //     'min'=> (int)$productPriceMin,
            // ],
            'brand' => $listingBrand,
            'model' => $listingModel,
            'size' => $listingSize,
            'bezel' => $listingBezelType,
            'dial' => $listingDial,
            'band' => $listingBandMaterial,
            // 'band_type' => $listingBandType,
            // 'dial_markers' => $listingDialMarkers,
            // 'bezel_material' => $listingBezelMaterial,
            

        ];
        return $data;
    }

    public function getListingById($id)
    {

        $listingById = Listing::findOrFail($id);

        $product = Product::where('status', 1)->where('model_number', $listingById->description);

        $products = $product->get();

        $lowPrice =  $product->min('price');

        $avgPriceSum =  $product->sum('price');
        $avgCount = $product->count();
        $avgTotal = $avgPriceSum == 0 && $avgCount == 0 ? 0 : (int)$avgPriceSum / (int)$avgCount;

//        dd(Product::moreCondition()[2]);

        $product = Product::where('status', 1)->where('model_number', $listingById->description)->where('more_condition', Product::moreCondition()[2]);
        $avgPapersBoxPriceSum = $product->sum('price');
        $avgPapersBoxCount = $product->count();
        $avgPapersBoxTotal = $avgPapersBoxPriceSum == 0 && $avgPapersBoxCount == 0 ? 0 :  (int)$avgPapersBoxPriceSum / (int)$avgPapersBoxCount;



        $product = Product::where('status', 1)->where('model_number', $listingById->description)->where('more_condition', Product::moreCondition()[1]);
        $avgPapersPriceSum = $product->sum('price');
        $avgPapersCount = $product->count();
        $avgPapersTotal = $avgPapersPriceSum == 0 && $avgPapersCount == 0 ? 0 : (int)$avgPapersPriceSum / (int)$avgPapersCount;


        $product = Product::where('status', 1)->where('model_number', $listingById->description)->where('more_condition', Product::moreCondition()[0]);
        $avgBoxPriceSum = $product->sum('price');
        $avgBoxCount = $product->count();
        $avgBoxTotal = $avgBoxPriceSum == 0 && $avgBoxCount == 0 ? 0 : (int)$avgBoxPriceSum / (int)$avgBoxCount;
//        dd($avgBoxTotal);


//        dd(ProductsResource::collection($products));
//        dd( new listingResource($listingById));
        $product = [
            'listing' => new ListingResource($listingById),
            'products' => ProductsResource::collection($products),
            'lowPrice' => round($lowPrice, 2),
            'avgTotal' => round($avgTotal, 2),
            'avgPapersBoxTotal' => round($avgPapersBoxTotal, 2),
            'avgPapersTotal' => round($avgPapersTotal, 2),
            'avgBoxTotal' => round($avgBoxTotal, 2),
//            'rating' => isset(Hellper::rating()['rating']['rating']) ? Hellper::rating()['rating']['rating'] : '',
        ];
        return  $product;
    }

}
