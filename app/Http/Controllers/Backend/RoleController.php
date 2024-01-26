<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::where('user_id', 'admin')->with('permissions')->get();
//        dd($roles);
        return view('backend.dashboard.rolePermission.role.index', compact('roles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $perm = Permission::get();
        $permissions = [];
        foreach ($perm as $permission){
            $company = explode('_', $permission->name);
            if ($company[0] == 'dashboard'){
                $permissions[] = $permission;
            }
        }
        return view('backend.dashboard.rolePermission.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Role::create(['name' => $request->role_name, 'user_id'=>'admin'])->givePermissionTo($request->permission);
        return redirect()->route('role.index')->with('success', 'Success added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id)->load('permissions');
        $perm = Permission::get();
        $permissions = [];
        foreach ($perm as $permission){
            $company = explode('_', $permission->name);
            if ($company[0] == 'dashboard'){
                $permissions[] = $permission;
            }
        }
        return view('backend.dashboard.rolePermission.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->role_name;
        $role->save();
        $role->syncPermissions($request->permission);

        return redirect()->route('role.index')->with('success', 'Success added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Success deleted');
    }

    public function permission()
    {
        $permissions =  Permission::get();
        return view('backend.dashboard.rolePermission.permission.index', compact('permissions'));
    }

}
