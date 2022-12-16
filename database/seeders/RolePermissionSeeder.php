<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at'     => now(),
            'remember_token'        => Str::random(10),
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ];

        DB::beginTransaction();

        try {
            $owner = User::create(array_merge([
                'name'          => 'Owner MC',
                'email'         => 'owner@mctechnologyofficial.com',
                'password'      => Hash::make('password'),
            ], $default_user_value));

            $admin = User::create(array_merge([
                'name'          => 'Admin MC',
                'email'         => 'admin@mctechnologyofficial.com',
                'password'      => Hash::make('password'),
            ], $default_user_value));

            $sales = User::create(array_merge([
                'name'          => 'Sales MC',
                'email'         => 'sales@mctechnologyofficial.com',
                'password'      => Hash::make('password'),
            ], $default_user_value));

            $developer = User::create(array_merge([
                'name'          => 'Developer MC',
                'email'         => 'developer@mctechnologyofficial.com',
                'password'      => Hash::make('password'),
            ], $default_user_value));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        $role_admin = Role::create(['name' => 'admin']);
        $role_sales = Role::create(['name' => 'sales']);
        $role_developer = Role::create(['name' => 'developer']);
        $role_owner = Role::create(['name' => 'owner']);

        $permission = Permission::create(['name' => 'read role']);
        $permission = Permission::create(['name' => 'create role']);
        $permission = Permission::create(['name' => 'update role']);
        $permission = Permission::create(['name' => 'delete role']);

        $role_admin->givePermissionTo('read role');
        $role_admin->givePermissionTo('create role');
        $role_admin->givePermissionTo('update role');
        $role_admin->givePermissionTo('delete role');

        $owner->assignRole('owner');
        $admin->assignRole('admin');
        $sales->assignRole('sales');
        $developer->assignRole('developer');


    }
}
