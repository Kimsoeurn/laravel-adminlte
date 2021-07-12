<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::getSchemaBuilder()->disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // reset cached roles and permissions
        //app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create User Permission
        Permission::insert(crud_permission('users', 2));
        Permission::create(['name' => 'change_own_account', 'group_name' => 'users', 'group_order' => 2]);
        Permission::insert(crud_permission('roles', 3));

        $role = Role::create(['name' => 'Super Admin']);
        $role = Role::where('name', 'Super Admin')->first();
//        $role->givePermissionTo(Permission::all());

        /**
         * Assign Role to user
         */
        $user = \App\Models\User::find(1);
        $user->assignRole($role);
        $user->save();
    }
}
