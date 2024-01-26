<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Member\CreateRequest;
use App\Http\Requests\Backend\Member\EditRequest;
use App\Jobs\AccessSendMailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{

    public function index($id)
    {
        $members = User::where('company_id', $id)->get();
        $company = User::findOrFail($id);
        return view('backend.dashboard.company.all_companies.member.index', compact('members', 'id', 'company'));
    }


    public function create($id)
    {
        return view('backend.dashboard.company.all_companies.member.create', compact('id'));
    }


    public function store(CreateRequest $request)
    {
        if ($request->password == null){
            $password = Hash::make(time());
        }else{
            $password = Hash::make($request->password);
        }
        DB::beginTransaction();
            $member = new User();
            $member->name = $request->name;
            $member->email = $request->email;
            $member->password = $password;
            $member->company = 0;
            $member->company_id = $request->company_id;
            $member->blocked_subscription = 0;
            $member->login_blocked = 0;
            $member->save();
            $data = [
                'password'=>$password,
                'email'=>  $member->email,
            ];
            dispatch(new AccessSendMailJob($data));
        DB::commit();
        return redirect()->route('member.index', $request->company_id)->with('success', 'Success added');
        DB::rollBack();
        return redirect()->route('member.index', $request->company_id)->with('error', 'Error dont added');
    }


    public function show($id)
    {
        //
    }

    public function edit($id, $company_id)
    {
        $member = User::findOrFail($id);
        return view('backend.dashboard.company.all_companies.member.edit', compact('member', 'company_id'));
    }


    public function update(EditRequest $request, $id)
    {
        if ($request->password == null){
            $password = Hash::make(time());
        }else{
            $password = Hash::make($request->password);
        }
        DB::beginTransaction();
        $member = User::findOrFail($id);
        $member->name = $request->name;
        $member->email = $request->email;
        if($request->password){
            $member->password = $password;
            $data = [
                'password' => $password,
                'email' => $request->email,
            ];
            dispatch(new AccessSendMailJob($data));
        }
        DB::commit();
        $member->save();
        return redirect()->route('member.index', $request->company_id)->with('success', 'Success updated');
        DB::rollBack();
        return redirect()->route('member.index', $request->company_id)->with('error', 'Error dont updated');
    }

    public function destroy($id, $company_id)
    {
        $member = User::findOrFail($id);
        $member->delete();
        return redirect()->route('member.index', $company_id)->with('success', 'Success deleted');
    }


    public function block($id)
    {
        $member = User::findOrFail($id);
//        dd($member);
        if ($member->login_blocked){
            $member->login_blocked = 0;
        }else{
            $member->login_blocked = 1;
        }
        $member->save();
        return redirect()->back()->with('success', 'Success');
    }




}
