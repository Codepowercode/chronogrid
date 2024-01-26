<?php

namespace App\Http\Controllers\Api;

use App\Exports\SalesProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\AuctionRequest;
use App\Http\Requests\Api\Product\CreateRequest;
use App\Http\Requests\Api\Product\EditRequest;
use App\Http\Requests\Api\Product\ProductCSVRequest;
use App\Http\Resources\Product\CompanyAuctionBiddedListResource;
use App\Http\Resources\Product\ProductsResource;
use App\Http\Services\ProductService;
use App\Models\Product;
use App\Models\ProductAuction;
use App\MyHellepr\Hellper;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    /**
     * @var ProductService
     */
    protected $productService;


    public function __construct()
    {
        $this->productService = app(ProductService::class);
    }
    public function getProducts(Request $request)
    {
        // get all product + filter !empty(filter) -> filtered products
        return response()->json(
            $this->productService->getProducts($request->all())
        );
    }

    public function getProductFilterType(Request $request)
    {
        return response()->json(
            $this->productService->getProductFilterType($request->all())
        );
    }
    public function getSelectInCreateProduct()
    {
        return response()->json(
            $this->productService->getSelectInCreateProduct()
        );
    }
    public function getListWithModelNumber(Request $request)
    {
        return response()->json(
            $this->productService->getListWithModelNumber($request->all())
        );
    }

    public function getCheckProductSerialNumber($serialNumber)
    {
        $data = $this->productService->getCheckProductSerialNumber($serialNumber);
        return response()->json($data, $data['code']);
    }

    public function create(CreateRequest $request) //CreateRequest todo
    {
        //required parameter [ 'brand' 'serial_number' 'model' 'color' 'size' 'metal' 'bezel_size' 'bezel_type' 'bezel_metal' 'bracelet_type' 'band' 'dial_type' 'price' 'auction':boolean ]
        //if auction = 1 required parameter [ + 'auction_start' 'auction_end' ]
        //Don`t required parameter [ 'auction_min_bid' ]
//        return $request->all();
        $data = $this->productService->create($request->all(), Hellper::companyId());
        return response()->json($data, $data['code']);
    }

    public function createCSV(Request $request)
    {
        //required parameter [ 'import_file', 'import_file_zip' ]
// todo ---------------------- Validation ------------------- //
        if (isset($request->import_file_zip)){
            $fileTypeZip = array_reverse(explode('.', $request->import_file_zip->getClientOriginalName()));
            if ($fileTypeZip[0] === 'zip') {
                if (filesize($request->import_file_zip) > 54000000) { // 50000000byte ~ 50mb
                    return response()->json([
                        'status' => false,
                        'message' => 'Wrong file size, max size 50mb',
                    ], 500);
                }
            }elseif (!isset($request->import_file)){
                return response()->json([
                    'status' => false,
                    'message' => 'Wrong file type, csv or xlsx',
                ], 500);
            }
        }

        // excel file
        if (isset($request->import_file)) {
            $fileType = array_reverse(explode('.', $request->import_file->getClientOriginalName()));
            if ($fileType[0] === 'csv' || $fileType[0] === 'xlsx') {
                if (filesize($request->import_file) > 2400000) { // 2000000byte ~ 2mb
                    return response()->json([
                        'status' => false,
                        'message' => 'Wrong file size, max size 2mb',
                    ], 500);
                }
            } elseif (!isset($request->import_file_zip)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Wrong file type, csv or xlsx',
                ], 500);
            }
        }
// todo ---------------------- Validation ------------------- //

        $data = $this->productService->createCSV($request->all(), Hellper::companyId());
        return response()->json(
           $data
        , $data['code']);
    }

    public function getProductById($id)
    {
        return response()->json(
            $this->productService->getProductById($id)
        );
    }


    public function update(EditRequest $request, $id)
    {
        //required parameter [ 'brand' 'serial_number' 'model' 'color' 'size' 'metal' 'bezel_size' 'bezel_type' 'bezel_metal' 'bracelet_type' 'band' 'dial_type' 'price' 'auction':boolean ]
        //if auction = 1 required parameter [ + 'auction_start' 'auction_end' ]
        //Don`t required parameter [ 'auction_min_bid' ]

        return response()->json(
            $this->productService->update($request->all(), $id)
        );
    }


    public function delete($id)
    {
        return response()->json(
            $this->productService->delete($id)
        );
    }


    public function deleteOneImage($id)
    {
        return response()->json(
            $this->productService->deleteOneImage($id)
        );
    }

    public function getAuctionBuySales($type)
    {
        return response()->json(
            $this->productService->getAuctionBuySales($type)
        );
    }

    public function getAuctionHistory($product_id)
    {
        return response()->json(
            $this->productService->getAuctionHistory($product_id)
        );
    }

    public function getMyAuctionHistory()
    {
        return response()->json(
            $this->productService->getMyAuctionHistory(Hellper::apiAuth(true))
        );
    }

    public function getWinAuctionHistory()
    {
        return response()->json(
            $this->productService->getWinAuctionHistory(Hellper::apiAuth(true))
        );
    }

    public function getAuctionList(Request $request)
    {
        return response()->json(
            $this->productService->getAuctionList($request->all())
        );
    }

    public function auctionHistory(AuctionRequest $request)
    {
        //required parameter [ 'product_id' 'price' 'status' ]
//        dd($request->all());
        $data = $this->productService->auctionHistoryCreate($request->all(), Hellper::companyId());
        return response()->json(
            $data
        , $data['code']);
    }

    public function productListCSV(ProductCSVRequest $request)
    {
        if (filesize($request['import_file']) > 2000000){ // 2000000byte ~ 2mb
            return ;
        }
        return response()->json(
            $this->productService->productListCSV($request->all())
        );
    }


// todo __________________________________________ 1.  Company products ___________________________________________________
    public function companyProductsList($status)
    {
        $company_id = Hellper::companyId();

        $products =  Product::where('user_id', $company_id)->with('company', 'images');
        if ($status == 'waiting' || $status == 'approved' || $status == 'rejected'){
            $products->where('status_position', $status);
        }
        $products = $products->orderBy('id', 'DESC')->paginate(9);


        return response()->json(
            [
                "status"=> true,
                "products"=> ProductsResource::collection($products),
                "filter"=> Product::settingsFilter(),
                "count"=> $products->total(), //Product::where('user_id', $company_id)
            ]);

    }


// todo __________________________________________ 1. Company bid list ___________________________________________________
    public function companyAuctionsBiddedList()
    {
        $auctions = ProductAuction::with('product')->get();

        return response()->json(
            [
                "status"=> true,
                "auction"=> CompanyAuctionBiddedListResource::collection($auctions),
            ]);
    }






}
