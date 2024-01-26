<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CreditController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| dev D.K.
*/


Auth::routes();

Route::post('/registration/validate', [AuthController::class,'registerValidate']); //todo
Route::post('/registration', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'loginApi']);
Route::post('/reset/password/code/mail', [AuthController::class, 'resetPasswordCodeMail']);
Route::post('/reset/password', [AuthController::class, 'resetPassword']);
Route::get('/subscriptions', [ApiController::class, 'subscription']);

Route::group([ 'prefix' => '/settings/orders/export'], function (){ // NO auth
    Route::get('/excel/download/{history}/{user_id}', [OrderController::class, 'downloadProduct']);  // todo no in api doc
    Route::get('/download/invoice/{order_id}', [OrderController::class, 'downloadInvoice']); //todo add column no in api doc

});



//Route::post('messages', [\App\Http\Controllers\ChatsController::class, 'message']);

Route::middleware('auth:api')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);



    Route::post('/global/search', [ApiController::class, 'homePageSearch']);
    Route::get('/global/search/filter/data/{type?}', [ApiController::class, 'homePageSearchFilterData']);


    Route::group([ 'prefix' => '/message'], function (){ // api/message
        // message
        Route::get('/messages/{room_id}', [MessageController::class, 'getMessages']);
        Route::post('/chat/send-message', [MessageController::class,'sendMessage']);

        //room
        Route::post('/create/room', [MessageController::class,'createRoom']);
        Route::get('/get/rooms', [MessageController::class, 'getRooms']);
        Route::get('/delete/{room_id}', [MessageController::class, 'deleteRoom']);

        Route::get('/search/{search}', [MessageController::class, 'getUser']);
    });



    Route::group([ 'prefix' => '/product'], function (){ // api/product
        // product private
        Route::post('/', [ProductController::class, 'getProducts']); // todo add count strukturayi popoxutyun + ?page=1
        Route::post('/filter/type/{brand?}', [ProductController::class, 'getProductFilterType']);  // todo
        Route::get('/serial/number/{serial}', [ProductController::class, 'getCheckProductSerialNumber']);  // todo
        Route::get('/selects', [ProductController::class, 'getSelectInCreateProduct']);
        Route::post('/list/model', [ProductController::class, 'getListWithModelNumber']); // todo
        Route::post('/create', [ProductController::class, 'create']);
        Route::post('/create/csv', [ProductController::class, 'createCSV']); //todo
        Route::get('/show/{id}', [ProductController::class, 'getProductById']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::get('/delete/{id}', [ProductController::class, 'delete']);
        Route::get('/delete/one/{id}', [ProductController::class, 'deleteOneImage']);
        Route::get('/auction/list/history/{product_id}', [ProductController::class, 'getAuctionHistory']);
        Route::get('/auction/list/bid/my', [ProductController::class, 'getMyAuctionHistory']); //todo
        Route::get('/auction/list/bid/win', [ProductController::class, 'getWinAuctionHistory']); //todo
        Route::get('/auction/list/{type}', [ProductController::class, 'getAuctionBuySales']); //todo
        Route::post('/auction', [ProductController::class, 'auctionHistory']);
        Route::post('/auction/list', [ProductController::class, 'getAuctionList']); //todo

        // test
        Route::post('/list', [ProductController::class, 'productListCSV']);
    });

    Route::group([ 'prefix' => '/listing'], function (){ // api/listing
        // listing private
        Route::post('/', [ListingController::class, 'getListings']); // todo add count strukturayi popoxutyun + ?page=1
        Route::post('/filter/type', [ListingController::class, 'getListingFilterType']);
        Route::get('/show/{id}', [ListingController::class, 'getListingById']);
    });

    Route::group([ 'prefix' => '/settings'], function (){ // api/settings

        Route::group([ 'prefix' => '/profile'], function (){ // api/settings/profile
            Route::get('/info/show', [UserController::class, 'getInfo']);
            Route::post('/info/update', [UserController::class, 'updateInfo']);
            Route::get('/info/delete/{id}', [UserController::class, 'deleteInfo']);
            Route::get('/address/get', [UserController::class, 'getInfoAddress']);
            Route::post('/address/create', [UserController::class, 'addInfoAddress']);
            Route::post('/address/update/{id}', [UserController::class, 'updateInfoAddress']);
            Route::get('/address/delete/{id}', [UserController::class, 'deleteInfoAddress']);

            Route::group([ 'prefix' => '/company'], function (){  // api/settings/profile/company
                Route::get('/information', [UserController::class, 'getCompanyInformation']); //todo
                Route::post('/information/access/email', [UserController::class, 'getCompanyInformationAccessEmail']); //todo
                Route::post('/information/update', [UserController::class, 'updateCompanyInformation']); //todo
                Route::delete('/account/delete', [UserController::class, 'accountDelete']); //todo
            });
        });

        Route::group([ 'prefix' => '/members'], function (){ // api/settings/members
            Route::get('/show', [UserController::class, 'getAllMembers']);
            Route::get('/edit/{id}', [UserController::class, 'getMemberById']); //todo petq chi
            Route::post('/create', [UserController::class, 'createUser']);
            Route::post('/update/{id}', [UserController::class, 'updateUser']);
            Route::get('/delete/{id}', [UserController::class, 'deleteUser']);
            Route::get('/get/roles', [UserController::class, 'getRole']);
            Route::get('/block/{id}', [UserController::class, 'blockUnblockUser']);
        });

        Route::group([ 'prefix' => '/role'], function (){  // api/settings/role
            Route::get('/get', [RoleController::class, 'getRoleSettings']);
            Route::get('/get/by/{id}', [RoleController::class, 'getRoleById']);
            Route::post('/create', [RoleController::class, 'createRole']);
            Route::post('/update/{id}', [RoleController::class, 'updateRole']);
            Route::get('/delete/{id}', [RoleController::class, 'deleteRole']);
            Route::get('/get/permissions', [RoleController::class, 'getPermission']);
        });

        Route::group([ 'prefix' => '/orders'], function (){  // api/settings/orders
            Route::post('/purchase/change/status/{status}', [OrderController::class, 'purchaseChangeStatus']);  // todo no in api doc
            Route::post('/purchase/leave/review', [OrderController::class, 'purchaseLeaveReview']);  // todo no in api doc
            Route::get('/buy/purchase', [OrderController::class, 'buyPurchaseCompanyOrdersList']);  // todo no in api doc
            Route::get('/buy/purchase/filter/{delivery}', [OrderController::class, 'buyPurchaseCompanyOrdersListFilter']);  // todo no in api doc
            Route::get('/buy/purchase/history', [OrderController::class, 'buyPurchaseCompanyOrdersListHistory']);  // todo no in api doc
            Route::get('/buy/sales', [OrderController::class, 'buySalesCompanyOrdersList']);  // todo no in api doc
            Route::get('/buy/sales/history/{type?}', [OrderController::class, 'buySalesCompanyOrdersListHistory']);  // todo no in api doc
            Route::get('/cancel/{order_id}', [OrderController::class, 'ordersCancel']);  // todo no in api doc
            Route::get('/get/status', [OrderController::class, 'getOrderStatus']);  // todo no in api doc
            Route::post('/change/status/delivery', [OrderController::class, 'changeOrderStatusDelivery']);  // todo no in api doc
            Route::post('/update/track/number', [OrderController::class, 'addOrderTrackNumber']);  // todo no in api doc
            Route::post('/update/label/shipping', [OrderController::class, 'addOrderLabelShipping']);  // todo no in api doc
            Route::post('/change/transfer/status', [OrderController::class, 'changeTransferStatusOrder']);  // todo no in api doc

            Route::group([ 'prefix' => '/export'], function (){  // api/settings/orders/export
                //excel working without token
//                Route::get('/excel/download/{history}/{user_id}', [OrderController::class, 'downloadProduct']);  // todo no in api doc
//                Route::get('/download/invoice', [OrderController::class, 'downloadInvoice']); //todo add column no in api doc
            });

            Route::group([ 'prefix' => '/offer'], function (){  // api/settings/orders/offer
//                Route::get('/get/{type}', [OfferController::class, 'getCreditsBuyerOrSeller']); //todo no in api doc CREDIT
                Route::get('/get/{type}/{offer}/{delivery}', [OfferController::class, 'getOffersBuyerOrSeller']); //todo no in api doc OFFER
                Route::post('/create', [OfferController::class, 'createOffer']); //todo no in api doc
                Route::post('/delivery/change', [OfferController::class, 'offerDeliveryChange']); //todo no in api doc
            });


        });

        Route::group([ 'prefix' => '/company'], function (){  // api/settings/company
            Route::get('/{status?}/products/', [ProductController::class, 'companyProductsList']); //todo
            Route::get('/auctions', [ProductController::class, 'companyAuctionsBiddedList']);
        });


        Route::group([ 'prefix' => '/notification'], function (){ // api/settings/notification
            Route::get('/', [NotificationController::class, 'GetNotification']);
        });


    });

    Route::group([ 'prefix' => '/order'], function (){  // api/order
        Route::get('/get/buy/step-one/info/{product_id}', [OrderController::class, 'getBuyStepOneInfo']);  // todo no in api doc

        Route::post('/create', [OrderController::class, 'createOrder']); //todo add column no in api doc
    });



    Route::post('/auth/user/info', [ApiController::class, 'authUser']);
});


Route::group([ 'prefix' => '/seller'], function (){  // api/seller
    Route::get('/single/{id}', [UserController::class, 'getSellerSinglePage']); //todo no in api doc
    Route::post('/search', [UserController::class, 'searchCompany']);
    Route::get('/list/search', [UserController::class, 'searchCompanyList']);
});









// todo ------        test

Route::get('/change/all/delivery/{delivery}', [OrderController::class, 'forTeste']); //todo no in api doc





