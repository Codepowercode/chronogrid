<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserInfo;
use DB;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $admin = User::create([
            'name' => 'admin',
            'type' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'login_blocked' => 0,
            'company' => 0,
        ]);

        $support = User::create([
            'name' => 'Support',
            'type' => 'support',
            'email' => 'support@gmail.com',
            'password' => Hash::make('password'),
            'login_blocked' => 0,
            'company' => 0,
        ]);

        User::create([
            'name' => 'company',
            'type' => 'company',
            'email' => 'company@gmail.com',
            'password' => Hash::make('password'),
            'login_blocked' => 0,
            'company' => 1,
            'subscription_id' => 1,
            'subscription_start' => '2022-07-06 08:31:10',
        ]);

        User::create([
            'name' => 'company1',
            'type' => 'company',
            'email' => 'company1@gmail.com',
            'password' => Hash::make('password'),
            'login_blocked' => 0,
            'company' => 1,
            'subscription_id' => 1,
            'subscription_start' => '2022-07-06 08:31:10',
        ]);

        User::create([
            'name' => 'company2',
            'type' => 'company',
            'email' => 'company2@gmail.com',
            'password' => Hash::make('password'),
            'login_blocked' => 0,
            'company' => 1,
            'subscription_id' => 1,
            'subscription_start' => '2022-07-06 08:31:10',
        ]);

        $infoData = [
            [
                "cell_phone" => "1123",
                "company_name" => "123",
                "company_number" => "1123",
                "contact_name" => "123",
                "email" => "123",
            ],
            [
                "cell_phone" => "321",
                "company_name" => "321",
                "company_number" => "321",
                "contact_name" => "321",
                "email" => "321",
            ],
        ];


        $business_hours = [
            [
                "weekday" => 1,
                "from" => "9:00",
                "to" => "18:00",
            ],
            [
                "weekday" => 2,
                "from" => "9:00",
                "to" => "18:00",
            ],
        ];



        UserInfo::create([
            'user_id' => 3,
            'type' => 3,
            'phone_number' => '+454654465465454',
            'alt_phone_number' => '+6565656565656565',
            'website' => 'https://chronogrid.com/',
            'company_contact' => 'test',
            'business_hours' => json_encode($business_hours),
            'trade' => json_encode($infoData),
            'iwjg_member_number' => 'test',
            'rapnet_member_number' => 'test',
            'jbt_member_number' => 'test',
            'poligon_member_number' => 'test',
            'tawd' => 0,
            'bank_information' => 'test',
        ]);

        UserAddress::create([
            'user_id' => 3,
            'address_1' => 'newyork',
            'address_2' => 'hayastan',
            'city' => 'holliday',
            'state' => '12315651651',
            'postal_code' => '88888',
            'type' => 'billing',
        ]);

        UserAddress::create([
            'user_id' => 3,
            'address_1' => 'newyork',
            'address_2' => 'hayastan',
            'city' => 'holliday',
            'state' => '12315651651',
            'postal_code' => '88888',
            'type' => 'shipping',
        ]);


        $user_company = User::create([
            'name' => 'user_company',
            'type' => 'member',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'login_blocked' => 0,
            'company' => 0,
            'company_id' => 3,
        ]);

        //Create roles with Permission seeder
        $crudPermissions = ['index', 'create', 'edit', 'delete'];
        $trashPermissions = ['trash', 'restore', 'force-delete'];

        $permissions = [
            //access dashboard login
            'dashboard',

            //Companies -> All Companies
            'dashboard_company_tab',  // +
            'dashboard_company_view',  //-
            'dashboard_company_create',  // +
            'dashboard_company_edit',  // +
            'dashboard_company_delete', //+
            'dashboard_company_info',  // +
            'dashboard_company_block',  //+
            'dashboard_company_view_employee', // +
            'dashboard_company_employee_create', // +
            'dashboard_company_employee_edit',  // +
            'dashboard_company_employee_delete', // +
            'dashboard_company_employee_block_unblock', // +

            'dashboard_company_tab_deleted_companies',
            'dashboard_company_show_deleted_companies',
            'dashboard_company_deleted_companies_delete',

            //Companies -> Companies access
            'dashboard_company_access_tab',  // +
            'dashboard_company_access_view',
            'dashboard_company_access_acceptance',  // +
            'dashboard_company_access_info',  // +
            'dashboard_company_access_delete',  // +

            //Companies -> Companies blocked
            'dashboard_company_blocked_tab',  // +
            'dashboard_company_blocked_view',
            'dashboard_company_blocked_info',  // +
            'dashboard_company_blocked_unblock',  // +
            'dashboard_company_blocked_delete',  // +

            //Subscription
            'dashboard_subscription_tab',  // +
            'dashboard_subscription_view',
            'dashboard_subscription_create', // + +
            'dashboard_subscription_edit',  // + +
            'dashboard_subscription_delete',  // +

            //Auctions
            'dashboard_auction_tab',  // +
            'dashboard_auction_view',  // + +

            //Product Verify
            'dashboard_product_verify_tab',  // +
            'dashboard_product_verify_info', // + +
            'dashboard_product_verify_access',  // +
            'dashboard_product_verify_delete',  // +

            //Listing
            'dashboard_listing_tab',  // +
            'dashboard_listing_create',  // +
            'dashboard_listing_edit',   // + +
            'dashboard_listing_delete',  // +

            //Role
            'dashboard_permission_tab',  // + +
            'dashboard_role_tab',  // + +
            'dashboard_role_create',  // + +
            'dashboard_role_edit',  // + +
            'dashboard_role_delete',  // +

            //Support
            'dashboard_support_tab',  //+
            'dashboard_support_create', // + +
            'dashboard_support_role_create', // +
            'dashboard_support_edit', // + +
            'dashboard_support_role_edit', // +
            'dashboard_support_delete', // +
        ];
//
        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $companies = [  //Company
            'company',
            'company_member',
            'company_member_auction_participate',
            'company_member_create_product',
            'company_member_edit_product',
        ];
        foreach ($companies as $companyPermission){
            Permission::create(['name' => $companyPermission, 'guard_name' => 'api']);
        }



        Role::create(['name' => 'admin', 'user_id'=>'admin', 'guard_name' => 'web'])->givePermissionTo(Permission::query()->where('guard_name', 'web')->get());
        Role::create(['name' => 'support', 'user_id'=>'admin', 'guard_name' => 'web'])->givePermissionTo('dashboard');



        $permissions = Permission::all();

        $perm = [];
        foreach ($permissions as $permission){
            $company = explode('_', $permission->name);
            if ($company[0] == 'company'){
                $perm[] = $permission->name;
            }
        }

        Role::create(['name' => 'company','company_roles_name' => 'company', 'guard_name' => 'api'])->givePermissionTo([$perm]);

        $role = Role::create(['name' => 'company_member', 'user_id' => 3 ,'company_roles_name' => 'company member', 'guard_name' => 'api']);
//        Role::create(['name' => 'user'])->givePermissionTo([
//            'create'
//        ]);

//        dd($user_company->assignRole('company_member'));
        $admin->assignRole('admin');
        $support->assignRole('support');
        $user_company->assignRole($role);

    }
}
