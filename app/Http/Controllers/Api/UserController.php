<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\EditRequest;
use App\Http\Resources\Company\CompanyInfoResource;
use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\Product\CompanyAuctionBiddedListResource;
use App\Http\Resources\Product\ProductsResource;
use App\Http\Resources\RolePermission\RoleResource;
use App\Http\Resources\User\SearchUserResource;
use App\Http\Resources\User\UserInfoResource;
use App\Http\Resources\User\UserResource;
use App\Jobs\SupportRegisterSendMailJob;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAuction;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCard;
use App\Models\UserInfo;
use App\MyHellepr\Hellper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Shared\TimeZone;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

// todo ------------------------------------------- info CRUD -------------------------------------------
    public function getInfo()
    {
        $user = User::findOrFail(Hellper::companyId())->load('info', 'address', 'card', 'subscription');
        return  response()->json(new UserResource($user));
    }

    // [ createInfo ] in register page

    public function updateInfo(Request $request)
    {

        try {
            DB::beginTransaction();
                $user_id = Hellper::apiAuth(true)->id;

                $request =  isset($request['company']['email']) ? $request['company'] : $request;

                $userCard = [];
                if (!empty($request['card'])){
                    $card = UserCard::query()->where('user_id', $user_id)->count();
                    if ($card){
                        UserCard::query()->where('user_id', $user_id)->delete();
                    }
                    foreach ($request['card'] as $card) {
                        $userCard = new UserCard();
                        $userCard->user_id = $user_id;
                        $userCard->type = $card['type'];
                        $userCard->card_number = $card['card_number'];
                        $userCard->save();
                    }
                }


                $userInfo = [];
                if (!empty($request['info'])){

                    $userInfo = UserInfo::query()->where('user_id', $user_id)->first();
//                    $userInfo = new UserInfo();
//                    $userInfo->user_id = $user_id;
                    $userInfo = UserInfo::query()->updateOrCreate(
                        ['user_id'=>$user_id],
                        [
                            'type'=>$request['info']['type'],
                            'phone_number'=>$request['info']['phone_number'],
                            'alt_phone_number'=>$request['info']['alt_phone_number'],
                            'website'=>$request['info']['website'],
                            'company_contact'=>$request['info']['company_contact'],
                            'business_hours'=> json_encode($request['info']['business_hours']),
                            'trade'=>json_encode($request['info']['trade']),
                            'iwjg_member_number'=>$request['info']['iwjg_member_number'],
                            'rapnet_member_number'=>$request['info']['rapnet_member_number'],
                            'jbt_member_number'=>$request['info']['jbt_member_number'],
                            'poligon_member_number'=>$request['info']['poligon_member_number'],
                            'tawd'=> isset($request['info']['tawd']) ? 1 : 0,
                            'bank_information'=>json_encode($request['info']['bank_information']),
                            'about_company'=>$request['info']['about_company'],
                        ]
                    );
                }

                $userPassword = '';
                $user = User::findOrFail(Hellper::apiAuth()->id);
                if (isset($request['password'])){
                    $user->password = Hash::make($request['password']);
                    $user->save();
                    $userPassword = 'Password changes';
                }
                $userSubscription = '';
                if (isset($request['subscription_id'])){
                    $user->subscription_id = $request['subscription_id'];
                    $user->subscription_start = Carbon::now();
                    $user->save();
                    $userSubscription = 'Subscription changes';
                }

                $fileName = '';
                if (isset($request['path']) && $user->path != $request['path']){
                    if (explode('/', $request['path'])[0] == 'assets'){
                        $user->path = $request['path'];
                        $user->save();
                    }else{
                        $fileName =  Hellper::base64($request['path'], 'user', 'image');
                        $user->path = $fileName;
                        $user->save();
                    }
                }

            DB::commit();
            return response()->json(
                [
                    "status"=> true,
                    "message"=> "Successfully updated",
                    "card" => $userCard,
                    "info" => new UserInfoResource($userInfo),
                    "avatar" => $fileName,
                ], 200);
        }catch (\Exception $error){
            DB::rollBack();

            return response()->json(
                [
                    "status"=> false,
                    "message"=> "error DB",
                    "messagess"=> $user->path,
                    "messagesss"=> $request['path'],
                    'error'=> [
                        'error'=> $error->getMessage(),
                        'errorCode'=> $error->getCode(),
                        'errorFile'=> $error->getFile(),
                        'errorLine'=> $error->getLine(),
                    ],
                ], 401);
        }

    }

    public function deleteInfo($id){
        $companyInfo = UserInfo::findOrFail($id);
        $companyInfo->delete();
        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully deleted",
            ], 200);
    }

//todo ------------------------------------------- [ END info] -------------------------------------------





//todo ------------------------------------------- [ address] -------------------------------------------

    public function getInfoAddress()
    {
        $user = Hellper::apiAuth()->load(['address' => function($q){
            $q->orderByDesc('id');
        }]);
        return  response()->json($user->address, 200);
    }

    public function addInfoAddress(Request $request)
    {
        if ($request->all()){
//            foreach ($request->all() as $address) {
                $userAddress = new UserAddress();
                $userAddress->user_id = Hellper::companyId();
                $userAddress->address_1 = $request->address_1 ?? '';
                $userAddress->address_2 = $request->address_2 ?? '';
                $userAddress->city = $request->city ?? '';
                $userAddress->state = $request->state ?? '';
                $userAddress->postal_code = $request->postal_code ?? '';
                $userAddress->type = $request->type ?? '';
                $userAddress->save();
//            }
        }else {
            return response()->json(
                [
                    "status" => false,
                    "message" => "no data",
                ], 401);
        }

        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully added",
            ], 200);
    }

    public function updateInfoAddress(EditRequest $request, $id)
    {
        $userAddress = UserAddress::findOrFail($id);
        $userAddress->user_id = Hellper::companyId();
        $userAddress->address_1 = $request->address_1;
        $userAddress->address_2 = $request->address_2;
        $userAddress->city = $request->city;
        $userAddress->state = $request->state;
        $userAddress->postal_code = $request->postal_code;
        $userAddress->type = $request->type;
        $userAddress->save();
        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully updated",
            ], 200);
    }

    public function deleteInfoAddress($id){
        $companyInfoAddress = UserAddress::findOrFail($id)->delete();
        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully deleted",
            ], 200);
    }

//todo ------------------------------------------- [ end address] -------------------------------------------


// todo --------------------------------------------------------------------------------------
    public function getCompanyInformation(){
//        dd($id);
        $company = User::findOrFail(Hellper::companyId())->load('info', 'card', 'address', 'event');
        return response()->json(
            [
                "status"=> true,
                "company" => new CompanyInfoResource($company),
            ], 200);

    }

    public function getCompanyInformationAccessEmail(Request $request){
//        dd($id);
        $status = AuthController::AccessCode($request->email, false);

        return response()->json([
            'status' => $status['status'],
            'message' => $status['message'],
        ], $status['code']);

    }

    public function updateCompanyInformation(Request $request)
    {

        $company = User::findOrFail(Hellper::apiAuth()->id);
        $company->name = $request->name;

        if (isset($request->image)){
            $fileName =  Hellper::base64($request->image, 'user', 'image');
            $company->path = $fileName;
        }

        if ($request->code === $company->reset_password_code || $company->email === $request->email){
            $company->email = $request->email;
        }
        if (isset($request->password)) {
            if ($request->password == $request->password_confirmation) {
                $company['password'] = Hash::make($request->password);
            } else {
                return response()->json(
                    [
                        "status"=> false,
                        "message"=> "Password dont same.",
                    ], 500);
            }
        }
//        $company->save();
        if ($company->save()){
            $delHash = Hellper::apiAuth();
            $delHash->reset_password_code = null;
            $delHash->save();
        }


        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully",
                "company"=> "$company",
            ], 200);
    }

    public function accountDelete()
    {
//        dd($id);

        DB::beginTransaction();
            $company = User::findOrFail(Hellper::apiAuth()->id);
            if (in_array($company->type, ['admin', 'support'])){
                DB::rollBack();
                return response()->json(
                    [
                        "status"=> false,
                        "message" => 'you dont hav delete this user',
                    ], 401);
            }
            if ($company->company == 1){
                $members = User::query()->where('company_id', $company->id)->get();
                if (count($members)){
                    foreach ($members as $member){
                        $member->delete();
                    }
                }
                if (is_dir(storage_path("/app/public/users/" . $company->id))) {
                    File::deleteDirectory(public_path("/app/public/users/" . $company->id));
                }
                $company->delete();
                \Auth::guard('api')->logout();
            }else{
                $company->delete();
                \Auth::guard('api')->logout();
            }
        DB::commit();
        return response()->json(
            [
                "status"=> true,
                "message" => 'Deleted',
            ], 200);

    }


    public function searchCompanyList()
    {

        DB::beginTransaction();
        $auth_user = Hellper::companyId();
        $company = User::query()->where('company', 1)->where('id', '!=', $auth_user)->get()->map(function ($q){
            return Hellper::filterUserResource($q->id);
        });
//            dd($company);
        DB::commit();
        return response()->json(
            [
                "status"=> true,
                "companies"=> $company,
                "message" => 'Successfully',
            ], 200);

    }


    public function searchCompany(Request $request)
    {
        DB::beginTransaction();
        $auth_user = Hellper::companyId();
            if (isset($request->limit)){
                $limit = $request->limit;
            }else{
                $limit = 10;
            }
            $company = User::query()->where('company', 1)->where('id', '!=', $auth_user)->where('name',  'like' , '%'. $request->company_name . '%')->paginate($limit);
        DB::commit();
        return response()->json(
            [
                "status"=> true,
                "companies"=> SearchUserResource::collection($company),
                "count"=> $company->total(),
                "page_count"=> $limit,
                "message" => 'Successfully',
            ], 200);

    }


// todo --------------------------------------------------------------------------------------






// todo ------------------------------------------- Members CRUD -------------------------------------------

    public function getRole()
    {
        $company_id = Hellper::companyId();

        $roles = Role::where('user_id', $company_id)->get();

        return response()->json(
            [
                "status"=> true,
                "roles"=> $roles,
            ]);
    }

    public function getAllMembers()
    {
        $company_id = Hellper::companyId();

        $members = User::query()->where('company_id', $company_id)->with('roles')->get();
        return response()->json(
            [
                "status"=> true,
                "members"=> MemberResource::collection($members),
            ]);
    }

    public function getMemberById($id)
    {
        $member = User::findOrFail($id)->load(['roles'=>function($q){
            $q->with('permissions')->pluck('name');
        }]);
//        dd($member->roles);
        return response()->json(
            [
                "status"=> true,
                "member"=> Hellper::filterUser($member),
//                "roles"=> RoleResource::collection($member->roles),
                "roles"=> $member->roles,
            ]);
    }

    public function createUser(Request $request)
    {
//        return $request->all();
        if ($request->email === Hellper::apiAuth()->email){
            return response()->json(
                [
                    "status"=> false,
                    "message"=> "Electron mail should be unique",
                ]);
        }
        DB::beginTransaction();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = null;
        $user->company = 0;
        $user->company_id = Hellper::companyId();
        $user->login_blocked = 0;
        if($request->password == $request->password_confirmation){
            $user->password = Hash::make($request->password);
        }else{
            return response()->json(
                [
                    "status"=> false,
                    "message"=> "Password dont same.",
                ]);
        }

        $user->assignRole($request->role);
        $user->save();

        $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();

        DB::commit();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'permissions' => $permissions,
        ];
        dispatch(new SupportRegisterSendMailJob($data));

        return response()->json(
            [
                "status"=> true,
                "message"=> "User successfully added.",
                "permissions"=> $permissions,
                'company_user' => $user,
            ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id)->load('roles');
        DB::beginTransaction();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = null;
        $user->company = 0;
        $user->company_id = Hellper::companyId();
        if (isset($request->password)) {
            if ($request->password == $request->password_confirmation) {
                $user['password'] = Hash::make($request->password);
            } else {
                return response()->json(
                    [
                        "status"=> false,
                        "message"=> "Password dont same.",
                    ]);
            }
        }
        $user->save();
        $user->syncRoles([]);
        $user->assignRole($request->role);
        DB::commit();
        return response()->json(
            [
                "status"=> true,
                "message"=> "User successfully updated.",
                'company_user' => $user,
            ]);
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();

        $user = User::findOrFail($id);
        if (Hellper::companyId() == $user->company_id){
            $user->syncRoles([]);
            $user->delete();
        }else{
            DB::rollBack();
            return response()->json(
                [
                    "status"=> false,
                    "message"=> "It is not your member",
                ]);
        }
        DB::commit();

        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully deleted",
            ]);
    }

    public function blockUnblockUser($id)
    {
        $user = User::findOrFail($id);
        $company_id = Hellper::companyId();
        if ($company_id == $user->id){
            return response()->json(
                [
                    "status"=> false,
                    "message"=> "This user is not a participant in your company.",
                ]);
        }
        $unblocked = false;
        $blocked = false;
        DB::beginTransaction();
        if ($user->login_blocked == 1){
            $user->login_blocked = 0;
            $unblocked = true;
        }else {
            $user->login_blocked = 1;
            $blocked = true;
        }

        $user->save();
        DB::commit();

        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully",
                "blocked"=> $blocked,
                "unblocked"=> $unblocked,
            ]);
    }

    public function getSellerSinglePage($id)
    {

        $user = User::findOrFail($id)->load('ratingCompany');
//        dd($user);
        $productsCompany = Product::query()->where('user_id', $user->id)->paginate(10);
//        dd($productsCompany);
        $order = Order::query()->where('seller_id',  $user->id)->count();

        $output = [];
        $feed_back = [];
        $positiveFeedback = '';
        if (!empty($user->ratingCompany->toArray())){
            $count = $user->ratingCompany->count();
            $feed_back = $user->ratingCompany->map(function ($q){
                $out = [
                    'user_name' => User::findOrFail($q->user_id)->name,
                    'feed_back' => $q->feed_back,
                    'rating_payment_process' => $q->rating_payment_process,
                    'rating_overall_experience' => $q->rating_overall_experience,
                    'rating_communication' => $q->rating_communication,
                    'created_at' => $q->created_at,
                ];
                return $out;
            })->toArray();
            $rating_payment_process = $user->ratingCompany->sum('rating_payment_process') / $count;
            $rating_overall_experience = $user->ratingCompany->sum('rating_overall_experience') / $count;
            $rating_communication = $user->ratingCompany->sum('rating_communication') / $count;

            $positiveSum = ($rating_payment_process + $rating_overall_experience + $rating_communication) / 3;

            $positiveFeedback = ($positiveSum * 100) / 5;

            $output = [
                'rating_payment_process' => $rating_payment_process,
                'rating_overall_experience' => $rating_overall_experience,
                'rating_communication' => $rating_communication,
//                'company' => new UserResource($user),
            ];
        }

//        dd($productsCompany);
        return response()->json(
            [
                "status"=> true,
                "shop"=> [
                    'count' => $productsCompany->total(),
                    'products' => ProductsResource::collection($productsCompany),
                ],
                "rating"=> $output,
                "feed_back"=> $feed_back,
                "positive_feedback_percent"=> $positiveFeedback,
//                "positive_feedback_percent"=> number_format($positiveFeedback, 2, '.', ""),
                "company"=>  new UserResource($user),
                "order_sell"=> $order,
            ]);
    }

// todo ------------------------------------------- [END] Members CRUD -------------------------------------------


// todo ------------------------------------------- Message -------------------------------------------
// https://chatify.munafio.com/installation

// todo ------------------------------------------- Notification -------------------------------------------








/*

*/






}

