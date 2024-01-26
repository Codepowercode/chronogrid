<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RolePermission\RoleResource;
use App\MyHellepr\Hellper;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{


    public function getPermission()
    {
        $permissions = Permission::all();

        $perm = [];
        foreach ($permissions as $permission){
            $company = explode('_', $permission->name);
            if ($company[0] == 'company'){
                $perm[] = $permission;
            }
        }
        return response()->json(
            [
                "status"=> true,
                "permission"=> $perm,
            ]);
    }

    public function getRoleSettings()
    {
        $company_id = Hellper::companyId();

        $roles = Role::where('user_id', $company_id)->with('permissions')->get();

        return response()->json(
            [
                "status"=> true,
                "roles"=> RoleResource::collection($roles),
            ]);
    }

    public function getRoleById($id)
    {
        $roles = Role::findOrFail($id)->load('permissions');

        return response()->json(
            [
                "status"=> true,
                "role"=> new RoleResource($roles),
            ]);
    }


    public function createRole(Request $request)
    {
        $company_id = Hellper::companyId();

        $role = Role::create(['name' => $request->role.'_'.$company_id, 'company_roles_name'=>$request->role, 'guard_name' => 'api', 'user_id' => $company_id])->givePermissionTo($request->permission);

        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully Role Created",
                "role"=> new RoleResource($role),
            ]);
    }

    public function updateRole(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $role->name = $request->role.'_'.$role->user_id;
        $role->company_roles_name = $request->role;
        $role->save();
        $role->syncPermissions($request->permission);

        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully Role Updated",
            ]);
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->delete();


        $company_id = Hellper::companyId();
        $roles = Role::where('user_id', $company_id)->with('permissions')->get();

        return response()->json(
            [
                "status"=> true,
                "message"=> "Successfully Role Deleted",
                "roles"=> RoleResource::collection($roles),
                "test"=> 'drel',
            ]);
    }




}
