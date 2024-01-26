<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Jobs\RegisterSendMailJob;
use App\Jobs\AccessCodeJob;
use App\Models\DeletedCompany;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserInfo;
use App\MyHellepr\Hellper;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    use AuthenticatesUsers;
    public function registerValidate(Request $request)
    {
        // request 1 parameter [email or card_number]
        if (isset($request->email)){
            Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
            ], $messages = [
                'email.required' => 'Email required',
                'email.unique' => 'Such a email exists',
            ])->validate();
        }
//        else{
//            Validator::make($request->all(), [
//                'card_number' => 'required|string|unique:user_info',
//            ], $messages = [
//                'card_number.required' => 'Card number required',
//                'card_number.unique' => 'Such a card exists',
//            ])->validate();
//        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully',
        ]);

    }

    public function register(Request $request)
    {
//        dd(156454);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255', //|unique:users,email
            'subscription_id' => 'nullable|string',

            'type' => 'required|string',
            'type_section' => 'nullable|string',
            'phone_number' => 'required|string',
            'alt_phone_number' => 'nullable|string',

            'billing_address_one' => 'required|string',
            'billing_address_to' => 'required|string',
            'billing_city' => 'required|string',
            'billing_state' => 'required|string',
            'billing_postal_code' => 'required|string',

            'trade1_cell_phone' => 'required|string',
            'trade1_company_name' => 'required|string',
            'trade1_company_number' => 'required|string',
            'trade1_contact_name' => 'required|string',
            'trade1_email' => 'required|string',

            'trade2_cell_phone' => 'nullable',
            'trade2_company_name' => 'nullable',
            'trade2_company_number' => 'nullable',
            'trade2_contact_name' => 'nullable',
            'trade2_email' => 'nullable',

            'iwjg_member_number' => 'nullable',
            'rapnet_member_number' => 'nullable',
            'jbt_member_number' => 'nullable',
            'poligon_member_number' => 'nullable',
            'tawd' => 'nullable',

            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'routing_number' => 'required|string',
//            'bank_addresss_line1' => 'required|string',
//            'bank_addresss_line2' => 'required|string',
            'bank_city' => 'required|string',
            'bank_state' => 'required|string',
            'bank_postal_code' => 'required|string',

        ]);

        $valid = User::query()->where('email', $validatedData['email'])->count();
        if ($valid){
            return response()->json([
                'status' => false,
                'message' => 'Email has already taken.',
            ], 422);
        }

        try {

            DB::beginTransaction();
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'subscription_id' => $validatedData['subscription_id'] ?? null,
                'type' => 'company',
                'subscription_start' => Carbon::now(),
                'company' => 1,
                'password' =>  Hash::make(md5(time())), // Hash::make($data['password']), // Hash::make(md5(time())),
            ]);


            $rol = Role::query()->where('name', 'company')->where('user_id', null)->first();
//            dd($rol);
            $user->assignRole($rol);


            $j = 0;
            for ($i = 1; $i <= 2; $i++){
                $trade[$j]['cell_phone'] = isset($validatedData['trade'.$i.'_cell_phone']) ? $validatedData['trade'.$i.'_cell_phone'] : null;
                $trade[$j]['company_name'] = isset($validatedData['trade'.$i.'_company_name']) ? $validatedData['trade'.$i.'_company_name'] : null;
                $trade[$j]['company_number'] = isset($validatedData['trade'.$i.'_company_number']) ? $validatedData['trade'.$i.'_company_number'] : null;
                $trade[$j]['contact_name'] = isset($validatedData['trade'.$i.'_contact_name']) ? $validatedData['trade'.$i.'_contact_name'] : null;
                $trade[$j]['email'] = isset($validatedData['trade'.$i.'_email']) ? $validatedData['trade'.$i.'_email'] : null;
                $j++;
            }

            $bankInformation = [
                'bank_name' => $validatedData['bank_name'] ?? null,
                'account_number' => $validatedData['account_number'] ?? null,
                'routing_number' => $validatedData['routing_number'] ?? null,
//                'bank_addresss_line1' => $validatedData['bank_addresss_line1'] ?? null,
//                'bank_addresss_line2' => $validatedData['bank_addresss_line2'] ?? null,
                'bank_city' => $validatedData['bank_city'] ?? null,
                'bank_state' => $validatedData['bank_state'] ?? null,
                'bank_postal_code' => $validatedData['bank_postal_code'] ?? null,
            ];


            UserInfo::create([
                'user_id' => $user->id,
                'type' => $validatedData['type'],
                'type_section' => $validatedData['type_section'],
                'phone_number' => $validatedData['phone_number'],
                'alt_phone_number' => $validatedData['alt_phone_number'],
                'business_hours' => null,

                'trade' => json_encode($trade),

                'iwjg_member_number' => isset($validatedData['iwjg_member_number']) ? $validatedData['iwjg_member_number'] : null,
                'rapnet_member_number' => isset($validatedData['rapnet_member_number']) ? $validatedData['rapnet_member_number'] : null,
                'jbt_member_number' => isset($validatedData['jbt_member_number']) ? $validatedData['jbt_member_number'] : null,
                'poligon_member_number' => isset($validatedData['poligon_member_number']) ? $validatedData['poligon_member_number'] : null,
                'tawd' => isset($validatedData['tawd']) ? $validatedData['tawd'] : 0,
                'bank_information' => json_encode($bankInformation) ?? null,
            ]);



            UserAddress::create([
                'user_id' => $user->id,
                'address_1' => $validatedData['billing_address_one'],
                'address_2' => $validatedData['billing_address_to'],
                'city' => $validatedData['billing_city'],
                'state' => $validatedData['billing_state'],
                'postal_code' => $validatedData['billing_postal_code'],
                'type' => 'billing',
            ]);

            if ($request->billing_or_shipping){
                UserAddress::create([
                    'user_id' => $user->id,
                    'address_1' => $validatedData['billing_address_one'],
                    'address_2' => $validatedData['billing_address_to'],
                    'city' => $validatedData['billing_city'],
                    'state' => $validatedData['billing_state'],
                    'postal_code' => $validatedData['billing_postal_code'],
                    'type' => 'shipping',
                ]);
            }else{
                UserAddress::create([
                    'user_id' => $user->id,
                    'address_1' => isset($request->shipping_address_one) ? $request->shipping_address_one : '',
                    'address_2' => isset($request->shipping_address_to) ? $request->shipping_address_to : '',
                    'city' => isset($request->shipping_city) ? $request->shipping_city : '',
                    'state' => isset($request->shipping_state) ? $request->shipping_state : '',
                    'postal_code' => isset($request->shipping_postal_code) ? $request->shipping_postal_code : '',
                    'type' => 'shipping',
                ]);
            }



            DB::commit();
            $data = [
                'name' => $user->name,
                'email' => $user->email,
            ];
            dispatch(new RegisterSendMailJob($data));
            return response()->json([
                'status' => true,
                'message' => 'Waiting in access with administrator',
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'e' => $e->getMessage()
            ], 401);

        }
    }

    public function loginApi(Request $request)
    {
//        dd($request->_token);
        // request 2 parameter [email, password]
        if (! $token = \Auth::guard('api')->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        if (in_array($user->type, ['admin', 'support'])){
            return response()->json([
                'status' => false,
                'message' => 'You cannot log in here, please log in from Admin Panel.'
            ], 401);
        }


//       for member company
        if($user->company_id != null || $user->company_id > 0){

            $deletedCompany = DeletedCompany::where('position_id', $user->company_id)->count();
            if ($deletedCompany > 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Account deleted'
                ], 401);
            }

            $member = User::findOrFail($user->company_id);
            if ($member->blocked_subscription || $member->login_blocked == 1 || $member->blocked == 1){
                return response()->json([
                    'status' => false,
                    'message' => 'Main account blocked'
                ], 401);
            }
        }

//       for company
        if($user->blocked_subscription == 1 || $user->login_blocked == 1 || $user->blocked == 1){
            if ($user->company && $user->blocked_subscription == 1){
                $message = 'Subscription time, please buy a subscription';
            }else{
                $message = 'Account blocked, please waiting access with administrator';
            }
            return response()->json([
                'status' => false,
                'message' => $message
            ], 401);
        }

        if($user->reset_password_code != null){
            $user->reset_password_code = null;
            $user->save();
        }

        return response()->json([
            'user'=>$user,
            'message' => 'Login successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }

    public function logout(){
        \auth()->logout();
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'LogOut User',
        ]);
    }

    public function resetPasswordSettings(Request $request)
    {
        // request 3 parameter [password, confirm_password]
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if ($request->password != $request->confirm_password){
            return response()->json([
                'status' => false,
                'message' => 'Confirm password dont equal password',
            ]);
        }

        $user = User::findOrFail(Hellper::apiAuth()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully reset password',
        ]);
    }

    public function resetPassword(Request $request)
    {
        // request 3 parameter [code, password, confirm_password]
        $validate = $request->validate([
            'code' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if ($request->password != $request->confirm_password){
            return response()->json([
                'status' => false,
                'message' => 'Confirm password dont equal password',
            ]);
        }

        $user = User::where('reset_password_code', $request->code)->first();

        if (!$user){
            return response()->json([
                'status' => false,
                'message' => 'Don\'t not exist this user',
            ]);
        }

        if ($user->reset_password_code != $request->code){
            return response()->json([
                'status' => false,
                'message' => 'Error reset password code',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->reset_password_code = null;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully reset password',
        ]);
    }

    public function resetPasswordCodeMail(Request $request)
    {
        // request 1 parameter [email]
        $status = self::AccessCode($request->email, true);

        return response()->json([
            'status' => $status['status'],
            'message' => $status['message'],
        ], $status['code']);

    }

    public static function AccessCode($email, $status = false){

      if ($status){
        $user = User::where('email', $email)->first();
          if (!$user){
              $mess = [
                  'status' => false,
                  'message' => 'Don\'t not exist this email',
                  'code' => 500,
              ];
              return $mess;
          }

          $mail = $user->email;
      }else{
          $user = Hellper::apiAuth();
          $mail = $email;
      }


        if ($user->login_blocked == 1 || $user->blocked == 1){
            $mess = [
                'status' => false,
                'message' => 'Please waiting access with administrator, account blocked',
                'code' => 500,
            ];
            return $mess;
        }
        $code = Str::random(15).md5($user->email);
        $user->reset_password_code = $code;
        $user->save();


        $data = [
            'code'=> $code,
            'email'=>  $mail,
        ];
        dispatch(new AccessCodeJob($data));


        $mess = [
            'status' => true,
            'message' => 'Successfully send email code for reset',
            'code' => 200,
        ];
        return $mess;
    }
}
