<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\CreateRequest;
use App\Http\Requests\Backend\Company\EditRequest;
use App\Jobs\AccessSendMailJob;
use App\Jobs\DeletedAccountJob;
use App\Mail\AccessSendMail;
use App\Models\DeletedCompany;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserInfo;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $companies = User::where('company', 1)->where('login_blocked', 0)->with(['info','subscription'])->get();

        return view('backend.dashboard.company.all_companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $subscriptions = Subscription::all();
        if (empty($subscriptions->toArray())){
            return redirect()->route('subscription.index', $subscriptions)->with('info', 'Please add subscription before create company');
        }
        return view('backend.dashboard.company.all_companies.create', compact('subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
//        dd($request->all());
        if ($request->password == null){
            $password = Hash::make(time());
        }else{
            $password = Hash::make($request->password);
        }

        DB::beginTransaction();
            $company = new User();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->password = $password;
            $company->company = 1;
            $company->company_id = null;
            $company->blocked_subscription = 0;
            $company->login_blocked = 0;
            $company->subscription_id = $request->subscription_id;
            if ($company->save()){
                if (!empty($request->info)){
                    foreach ($request->info as $info){
                        $companyInfo = new UserInfo();
                        $companyInfo->user_id = $company->id;
                        $companyInfo->address1 = $info['address1'];
                        $companyInfo->address2 = $info['address2'];
                        $companyInfo->city = $info['city'];
                        $companyInfo->state = $info['state'];
                        $companyInfo->postal_code = $info['postal_code'];
                        $companyInfo->phone_number = $info['phone_number'];
                        $companyInfo->fax_number = $info['fax_number'];
                        $companyInfo->website = $info['website'];
                        $companyInfo->skype = $info['skype'];
                        $companyInfo->cell_phone = $info['cell_phone'];
                        $companyInfo->company_type = $info['company_type'];
                        $companyInfo->country = $info['country'];
                        $companyInfo->business_type = $info['business_type'];
                        $companyInfo->premium = $info['premium'];
                        $companyInfo->save();
                    }
                }
            }
            //send email password
            $data = [
                'password'=>$password,
                'email'=>  $company->email,
            ];
            dispatch(new AccessSendMailJob($data));
            //[END] send email password
        DB::commit();
        return redirect()->route('company.index')->with('success', 'Success added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $company = User::findOrFail($id)->load('info', 'address', 'subscription');
        $subscriptions = Subscription::all();
        return view('backend.dashboard.company.all_companies.show', compact('company', 'subscriptions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $company = User::findOrFail($id)->load('info');
        $companyInfo = $company->info;
        $subscriptions = Subscription::all();
        return view('backend.dashboard.company.all_companies.edit', compact('company', 'subscriptions', 'companyInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $request, $id)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $company = User::findOrFail($id)->load('info');

            $company->name = $request->name;
            $company->email = $request->email;
            if ($request->password){
                $company->password = Hash::make($request->password);
            }
            $company->company = 1;
            $company->company_id = null;
            $company->blocked_subscription = 0;
            $company->login_blocked = 0;
            $company->subscription_id = $request->subscription_id;
            if ($company->save()){
                if (!empty($request->info)){

                    if (!empty($company->info)){
                        foreach ($company->info as $remove){
                            $remove->delete();
                        }
                    }
                    foreach ($request->info as $info){
                        $companyInfo = new UserInfo();
                        $companyInfo->user_id = $company->id;
                        $companyInfo->address1 = $info['address1'];
                        $companyInfo->address2 = $info['address2'];
                        $companyInfo->city = $info['city'];
                        $companyInfo->state = $info['state'];
                        $companyInfo->postal_code = $info['postal_code'];
                        $companyInfo->phone_number = $info['phone_number'];
                        $companyInfo->fax_number = $info['fax_number'];
                        $companyInfo->website = $info['website'];
                        $companyInfo->skype = $info['skype'];
                        $companyInfo->cell_phone = $info['cell_phone'];
                        $companyInfo->company_type = $info['company_type'];
                        $companyInfo->country = $info['country'];
                        $companyInfo->business_type = $info['business_type'];
                        $companyInfo->premium = $info['premium'];
                        $companyInfo->save();
                    }
                }
            }

            if ($request->password){
                $data = [
                    'password'=>$request->password,
                    'email'=>  $request->email,
                ];
                dispatch(new AccessSendMailJob($data));
            }


            DB::commit();
                return redirect()->route('company.index')->with('success', 'Success updated');
            } catch (\Throwable $e) {
             DB::rollBack();
                return $e;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $company = User::find($id);

        $deleteCompany = new DeletedCompany();
        $deleteCompany->position_id = $company->id;
        $deleteCompany->type = $company->type;
        $deleteCompany->name = $company->name;
        $deleteCompany->email = $company->email;
        $deleteCompany->rating = $company->rating;
        $deleteCompany->company = $company->company;
        $deleteCompany->company_id = $company->company_id;
        $deleteCompany->blocked_subscription = $company->blocked_subscription;
        $deleteCompany->subscription_id = $company->subscription_id;
        $deleteCompany->login_blocked = $company->login_blocked;
        $deleteCompany->blocked = $company->blocked;
        $deleteCompany->reset_password_code = $company->reset_password_code;
        $deleteCompany->subscription_id = $company->subscription_id;
        $deleteCompany->subscription_start = $company->subscription_start;
        if ($deleteCompany->save()){
            $data = [
                'email'=>  $company->email,
            ];
            dispatch(new DeletedAccountJob($data));
            $company->delete();
        }else{
            return redirect()->back()->with('error', 'error');
        }

        return redirect()->back()->with('success', 'Success deleted');
    }

    public function companyAccess()
    {
        $companies = User::where('company', 1)->where('login_blocked', 1)->where('blocked', 0)->orderBy('id', 'DESC')->get();
        return view('backend.dashboard.company.companies_access.index', compact('companies'));
    }


    public function access($id)
    {
        try {
            DB::beginTransaction();
                $password = Str::random(30);

                $company = User::find($id);
                $company->login_blocked = 0;
                $company->password = Hash::make($password);
                $company->save();
                $data = [
                  'name'=>$company->name,
                  'password'=>$password,
                  'email'=>  $company->email,
//                  'email'=>  "david656558a@gmail.com",
                ];

                dispatch(new AccessSendMailJob($data));
            //    $model = new AccessSendMail($data);
            //    Mail::to($company->email)->send($model);

            DB::commit();
            return redirect()->back()->with('success', 'success');
        } catch (\Throwable $error) {
            DB::rollBack();
            return  [
                'status' => false,
                'error'=> [
                    'error'=> $error->getMessage(),
                    'errorCode'=> $error->getCode(),
                    'errorFile'=> $error->getFile(),
                    'errorLine'=> $error->getLine(),
            ],
                'code'=> 401,
            ];
        }
    }

    public function companyBlockIndex()
    {
        $companies = User::query()->where('company', 1)->where('blocked', 1)->get();
        return view('backend.dashboard.company.companies_blocked.index', compact('companies'));
    }

    public function companyBlock($id)
    {
        DB::beginTransaction();

        $company = User::find($id);
        $company->login_blocked = 1;
        $company->blocked = 1;
        $company->save();
        $companyMembers = User::where('company_id', $id)->get();
        foreach ($companyMembers as $companyMember){
            $companyMember->login_blocked = 1;
            $companyMember->blocked = 1;
            $companyMember->save();
        }
        // todo later
        $data = [
            'name' => $company->name,
            'email' => $company->email,
            'message'=>  'Company blocked in administration',
        ];
        dispatch(new AccessSendMailJob($data));

        DB::commit();

        return redirect()->back();
    }
    public function companyUnblock($id)
    {
        DB::beginTransaction();
        $company = User::find($id);
        $company->login_blocked = 0;
        $company->blocked = 0;
        $company->save();
        $companyMembers = User::where('company_id', $id)->get();
        foreach ($companyMembers as $companyMember){
            $companyMember->login_blocked = 0;
            $companyMember->blocked = 0;
            $companyMember->save();
        }
        DB::commit();
        $data = [
            'name' => $company->name,
            'email' => $company->email,
            'message'=>  'Company Unblocked',
        ];
        dispatch(new AccessSendMailJob($data));
        return redirect()->back();
    }


    // ----------------------------- deleted companies --------------------------- //

    public function getDeletedCompany()
    {
        $deletedCompanies = DeletedCompany::all();
        return view('backend.dashboard.company.deleted_company.index', compact('deletedCompanies'));
    }

    public function showDeletedCompany($id)
    {
        $deletedCompany = DeletedCompany::findOrFail($id);
        return view('backend.dashboard.company.deleted_company.show', compact('deletedCompany'));
    }

    public function destroyDeletedCompany($id)
    {
        $deletedCompanies = DeletedCompany::findOrFail($id);
        $deletedCompanies->delete();
        return redirect()->back();
    }


}
