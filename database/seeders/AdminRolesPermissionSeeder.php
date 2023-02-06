<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //permission
        $admin_dashboard = Permission::create(['guard_name' => 'admin', 'name' => 'admin dashboard']); //1
        $admin_pengaturan = Permission::create(['guard_name' => 'admin', 'name' => 'admin pengaturan']); //2
        $admin_master = Permission::create(['guard_name' => 'admin', 'name' => 'admin master']); //3
        
        $admin_sistem = Permission::create(['guard_name' => 'admin', 'name' => 'admin sistem']); //4
        $admin_navigasi = Permission::create(['guard_name' => 'admin', 'name' => 'admin navigasi']); //5
        $admin_admin = Permission::create(['guard_name' => 'admin', 'name' => 'admin admin']); //6
        $admin_user = Permission::create(['guard_name' => 'admin', 'name' => 'admin user']); //7
        
        $admin_status = Permission::create(['guard_name' => 'admin', 'name' => 'admin info']); //8
        $admin_status = Permission::create(['guard_name' => 'admin', 'name' => 'admin status']); //9
        $admin_list = Permission::create(['guard_name' => 'admin', 'name' => 'admin list']); //10
        $admin_role = Permission::create(['guard_name' => 'admin', 'name' => 'admin role']); //11
        $user_list = Permission::create(['guard_name' => 'admin', 'name' => 'user list']); //12
        $user_role = Permission::create(['guard_name' => 'admin', 'name' => 'user role']); //13
        

        //roles
        $role_admin = Role::create(['guard_name' => 'admin', 'name' => 'Administrator']);
        $role_operator = Role::create(['guard_name' => 'admin', 'name' => 'Operator']);
        $role_manager = Role::create(['guard_name' => 'admin', 'name' => 'Manajer']);

        //give
        $role_admin->givePermissionTo(Permission::all());
        $role_operator->givePermissionTo(['admin dashboard','admin pengaturan']);

        $admin = Admin::FindorFail(1);
        $admin->assignRole($role_admin);

        $operator = Admin::FindorFail(2);
        $operator->assignRole($role_operator);


        
        
    }
}
