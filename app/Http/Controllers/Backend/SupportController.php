<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Requests\Backend\Support\CreateRequest;
use App\Jobs\SupportRegisterSendMailJob;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class SupportController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $supports = User::where('type', 'support')->with('roles')->get();

        return view('backend.dashboard.support.index', compact('supports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::where('user_id', 'admin')->get();
        return view('backend.dashboard.support.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request) //UserStoreRequest
    {
        DB::beginTransaction();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = 'support';
        if($user->password = $request->password == $user->password = $request->password_confirmation){
            $user['password'] = Hash::make($request->password);
        }else{
            return redirect()->route('user.create')
                ->with('error',
                    'Password dont same.');
        }
        $user->save();
        $user->assignRole($request->role);


        $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
//        dd($permissions);
        DB::commit();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'permissions' => $permissions,
        ];
        dispatch(new SupportRegisterSendMailJob($data));

        //Redirect to the users.index view and display message
        return redirect()->route('support.index')
            ->with('success',
                'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $support = User::findOrFail($id)->load('roles');
        $roles = Role::where('user_id', 'admin')->get();
        return view('backend.dashboard.support.edit', compact('support', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) //UserUpdateRequest
    {
        $user = User::findOrFail($id)->load('roles');

        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)){
            if($user->password = $request->password == $user->password = $request->password_confirmation){
                $user['password'] = Hash::make($request->password);
            }else{
                return redirect()->route('user.edit')
                    ->with('error',
                        'Password dont same.');
            }
        }
        $user->save();
        $user->syncRoles([]);
        $user->assignRole($request->role);

        return redirect()->route('support.index')
            ->with('success',
                'User successfully added.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()
            ->with('success',
                'support Deleted.');
    }
}
