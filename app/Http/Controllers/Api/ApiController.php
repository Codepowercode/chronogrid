<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ListingService;
use App\Http\Services\ProductService;
use App\Models\Subscription;
use App\MyHellepr\Hellper;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    protected $listingService;
    protected $productService;


    public function __construct()
    {
        $this->listingService = app(ListingService::class);
        $this->productService = app(ProductService::class);
    }

    public function subscription()
    {
        $subscriptions = Subscription::all();
        return response()->json([
            'subscriptions'=>$subscriptions,
        ]);
    }


    public function homePageSearch(Request $request)
    {
        switch ($request->type) {
            case 'master':
                $data = $this->listingService->getListings($request->all(), true);
                $code = 200;
                break;
            case 'individual':
                $data = $this->productService->getProducts($request->all(), true);
                $code = 200;
                break;
            case 'auction':
                $data =  $this->productService->getAuctionList($request->all());
                $code = 200;
                break;
            default:
                $data =  [
                        'status' => false,
                        'message' => 'oops no type, no result, please send type [master, individual, auction]',
                        'type' => $request->type,
                    ];
                $code = 401;
        }

        return response()->json($data, $code);

    }


    public function homePageSearchFilterData(Request $request)
    {
        switch ($request->type) {
            case 'master':
                $data = $this->listingService->getListingFilterType();
                $code = 200;
                break;
            case 'individual':
                $data = $this->productService->getProductFilterType();
                $code = 200;
                break;
            default:
                $data =  [
                    'status' => false,
                    'message' => 'oops no type, no result',
                    'type' => $request->type,
                ];
                $code = 401;
        }

        return response()->json($data, $code);

    }


    public function authUser()
    {
        $authUser = Hellper::apiAuth()->load('auction', 'product', 'info');

        dd($authUser);


        $data = [
            "id" => $authUser->id,
            "name" => $authUser->name,
            "email" => $authUser->email,
            "reset_password_code" => $authUser->reset_password_code,
            "company" => $authUser->company,
            "company_id" => $authUser->company_id,
            "blocked_subscription" => $authUser->blocked_subscription,
            "login_blocked" => $authUser->login_blocked,
            "blocked" => $authUser->blocked,
            "created_at" => $authUser->created_at,
            "updated_at" => $authUser->updated_at,
            "which_company"=> '11111111111',
            "auction" => [

            ],
            "products" => [

            ],
            "info" => [

            ],
            "orders" => [
                'orders_seller' => [

                ],
                'orders_buyer' => [

                ]
            ],
            'role' => '',
        ];

    }


}
