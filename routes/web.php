<?php

use App\Events\MyEvent;
use App\Events\StatusLiked;
use App\Exports\SalesProductsExport;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DocController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Models\Message;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| dev D.K.
*/


Route::get('/', function () {
    $messages = Message::limit(2)->orderBy('id', 'DESC')->get();

    return view('welcome', compact('messages'));
})->name('welcome');

Auth::routes();



//Route::redirect('/', '/login');
Route::redirect('/register', '/login');
Route::redirect('/home', '/admin');

//Route::middleware('auth')->redirect('/login', '/admin');



Route::get('/home/api/doc/watch', [App\Http\Controllers\DocController::class, 'indexFrontend'])->name('indexFrontend');
Route::get('/home/api/doc/watch/backend', [App\Http\Controllers\DocController::class, 'indexBackend'])->name('indexBackend');
Route::get('/home/api/doc/watch/backend/download/post-man', [App\Http\Controllers\DocController::class, 'downloadPostMan'])->name('downloadPostMan');

//////////////////////////////////   BackEnd   ///////////////////////////////////////
///
/// todo user -> company
///
Route::group(['prefix' => '/admin', 'namespace' => 'App\Http\Controllers\Backend', 'middleware'=> 'permission:dashboard'], function() { //'middleware'=> 'permission:dashboard' ,
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //company

    Route::get('/company/access', 'CompanyController@companyAccess')->name('company.access.index');
    Route::get('/company/access/{id}', 'CompanyController@access')->name('company.access');
    Route::get('/company/block', 'CompanyController@companyBlockIndex')->name('company.block.index');
    Route::get('/company/block/{id}', 'CompanyController@companyBlock')->name('company.block');
    Route::get('/company/unblock/{id}', 'CompanyController@companyUnblock')->name('company.unblock');
    Route::resource('/company', 'CompanyController');

    //member
    Route::get('/company/member/{company_id}', 'MemberController@index')->name('member.index');
    Route::get('/company/member/block/{member_id}', 'MemberController@block')->name('member.block');
    Route::get('/company/member/create/{company_id}', 'MemberController@create')->name('member.create');
    Route::post('/company/member/store', 'MemberController@store')->name('member.store');
    Route::get('/company/member/{member_id}/edit/{company_id}', 'MemberController@edit')->name('member.edit');
    Route::put('/company/member/{member_id}', 'MemberController@update')->name('member.update');
    Route::delete('/company/member/{member_id}/{company_id}', 'MemberController@destroy')->name('member.destroy');

    Route::get('/company/deleted/view', 'CompanyController@getDeletedCompany')->name('get.deleted.company');
    Route::get('/company/deleted/show/{id}', 'CompanyController@showDeletedCompany')->name('show.deleted.company');
    Route::delete('/company/deleted/{id}', 'CompanyController@destroyDeletedCompany')->name('destroy.deleted.company');

    Route::resource('/subscription', 'SubscriptionController');


    Route::group(['prefix' => '/auction'], function() {
        Route::get('/', 'AuctionController@index')->name('auction.index');
        Route::get('/show/{id}', 'AuctionController@show')->name('auction.show');
    });

    Route::group([ 'prefix' => '/product'], function (){
        Route::group([ 'prefix' => '/verify'], function (){
            Route::get('/', 'ProductVerifyController@index')->name('product.verify.index');
            Route::get('/show/{id}', 'ProductVerifyController@show')->name('product.verify.show');
            Route::post('/{id}', 'ProductVerifyController@verify')->name('product.verify.verify');
            Route::get('/delete/{id}', 'ProductVerifyController@delete')->name('product.verify.delete');
        });

    });

    Route::resource('/listing', 'ListingController');
    Route::post('/create/listing', 'ListingController@createListing')->name('create.listing');
    Route::get('/listing/filter/list', 'ListingController@filter')->name('listing.filter');
    Route::get('/delete/all/listing', 'ListingController@deleteAllListing')->name('delete.all');
    Route::resource('/support', 'SupportController');
    Route::resource('/role', 'RoleController');
    Route::get('/permission', 'RoleController@permission')->name('permission.index');


    Route::post('/zip', 'ListingController@zip')->name('zip');


});




//Route::post('/message', [MessageController::class,'sendMessage'])->name('message.send');


//Route::get('/create/customer', function (){ //todo worcing
//
//    $curl = curl_init();
//    curl_setopt_array($curl, array(
//        CURLOPT_URL => 'https://api.escrow.com/2017-09-01/customer',
//        CURLOPT_RETURNTRANSFER => 1,
//        CURLOPT_USERPWD => 'david656558a@gmail.com:Aa123456789',
//        CURLOPT_HTTPHEADER => array(
//            'Content-Type: application/json'
//        ),
//        CURLOPT_POSTFIELDS => json_encode(
//            array(
//                'phone_number' => '8885118600',
//                'first_name' => 'John',
//                'last_name' => 'Smith',
//                'middle_name' => 'Kane',
//                'address' => array(
//                    'city' => 'San Francisco',
//                    'post_code' => '10203',
//                    'country' => 'US',
//                    'line2' => 'Apartment 301020',
//                    'line1' => '1829 West Lane',
//                    'state' => 'CA',
//                ),
//                'email' => 'john@testingg5g.escrow.com',
//            )
//        )
//    ));
//
//    $output = curl_exec($curl);
//    dd($output);
//    echo $output;
//    curl_close($curl);
//
//
//    return view('checkout');
//});

//Route::get('/checkout', function (){
//
//    $curl = curl_init();
//    curl_setopt_array($curl, array(
//        CURLOPT_URL => 'https://api.escrow.com/2017-09-01/transaction',
//        CURLOPT_RETURNTRANSFER => 1,
//        CURLOPT_USERPWD => 'david656558a@gmail.com:Aa123456789',
//        CURLOPT_HTTPHEADER => array(
//            'Content-Type: application/json'
//        ),
//        CURLOPT_POSTFIELDS => json_encode(
//            array(
//                'currency' => 'usd',
//                'items' => array(
//                    array(
//                        'fees' => array(
//                            array(
//                                'payer_customer' => 'd1a9v9i7d@gmail.com',
//                                'type' => 'escrow',
//                                'split' => '0.5',
//                            ),
//                            array(
//                                'payer_customer' => 'david656558a@gmail.com',
//                                'type' => 'escrow',
//                                'split' => '0.5',
//                            ),
//                        ),
//                        'extra_attributes' => array(
//                            'with_content' => true,
//                        ),
//                        'inspection_period' => '259200',
//                        'description' => 'johnwick.com',
//                        'title' => 'johnwick.com',
//                        'schedule' => array(
//                            array(
//                                'payer_customer' => 'd1a9v9i7d@gmail.com',
//                                'amount' => '1000.0',
//                                'beneficiary_customer' => 'david656558a@gmail.com',
//                            ),
//                        ),
//                        'type' => 'domain_name',
//                        'quantity' => '1',
//                    ),
//                ),
//                'description' => 'The sale of johnwick.com',
//                'parties' => array(
//                    array(
//                        'customer' => 'd1a9v9i7d@gmail.com',
//                        'role' => 'buyer',
//                    ),
//                    array(
//                        'customer' => 'david656558a@gmail.com',
//                        'role' => 'seller',
//                    ),
//                ),
//            )
//        )
//    ));
//
//    $output = curl_exec($curl);
//    echo $output;
//    dd($output);
//    curl_close($curl);
//
//
//    return view('checkout');
//});


Route::get('/code/run/{type}', function ($type){
//    dd($type);
//    Artisan::call('migrate:fresh --seed');
//    dd(132);
    $command = '';
    if ($type == 'fresh--seed' || $type == '1'){
        $command = 'migrate:fresh --seed';
        $message = 'fresh --seed [success]';
    }
    elseif ($type == 'migrate' || $type == '2'){
        $command = 'migrate';
        $message = 'migrate [success]';
    }elseif ($type == 'composer' || $type == '6'){
        exec('composer i');
    }
    elseif ($type == 'storagelink' || $type == '3'){
        $command = 'storage:link';
        $message = 'storage:link [success]';
    }
    elseif ($type == 'job' || $type == '4'){

//        exec('nohup php artisan queue:work --daemon &');
//        $x = exec('jobs -l');

//        return dd($x);
        $command = 'queue:work';
        $message = 'job run  [success]';
    }
    elseif ($type == 'clear' || $type == '5'){
        $message = 'clear  [success]';
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        Artisan::call('cache:clear');
        return dd('dun '.$message);
    }
    else{
        echo 'commands: fresh--seed, migrate, storagelink';
        dd('error: no this command please add');
    }

    $artisan = Artisan::call($command);
    return dd('dun '.$message.' |  artisan command: '.$artisan);
});

//Route::get('queue-work', function () {
//    Artisan::call('queue:work --daemon &');
//});




