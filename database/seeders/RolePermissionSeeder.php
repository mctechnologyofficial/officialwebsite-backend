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
            'image'                 => 'storage/users/me.jfif'
        ];
        $owner = User::create(array_merge([
            'name'          => 'Owner MC',
            'email'         => 'owner@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => null,
        ], $default_user_value));

        $admin = User::create(array_merge([
            'name'          => 'Admin MC',
            'email'         => 'admin@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => null,
        ], $default_user_value));

        $marketing = User::create(array_merge([
            'name'          => 'Marketing MC',
            'email'         => 'marketing@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => null,
        ], $default_user_value));

        $leader = User::create(array_merge([
            'name'          => 'Leader Developer MC',
            'email'         => 'leader@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => 1,
        ], $default_user_value));

        $frontend = User::create(array_merge([
            'name'          => 'Frontend Developer MC',
            'email'         => 'frontend@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => 1,
        ], $default_user_value));

        $backend = User::create(array_merge([
            'name'          => 'Backend Developer MC',
            'email'         => 'backend@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => 1,
        ], $default_user_value));

        $mobile = User::create(array_merge([
            'name'          => 'Mobile Developer MC',
            'email'         => 'mobile@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => 1,
        ], $default_user_value));

        $uiux = User::create(array_merge([
            'name'          => 'UI/UX Designer MC',
            'email'         => 'uiux@mctechnologyofficial.com',
            'password'      => Hash::make('password'),
            'team_id'       => 1,
        ], $default_user_value));

        $role_owner = Role::create(['name' => 'owner']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_marketing = Role::create(['name' => 'marketing']);
        $role_leader = Role::create(['name' => 'leader developer']);
        $role_frontend = Role::create(['name' => 'frontend developer']);
        $role_backend = Role::create(['name' => 'backend developer']);
        $role_mobile = Role::create(['name' => 'mobile developer']);
        $role_uiux = Role::create(['name' => 'UI/UX designer']);

        $owner->assignRole('owner');
        $admin->assignRole('admin');
        $marketing->assignRole('marketing');

        $leader->assignRole('leader developer');
        $frontend->assignRole('frontend developer');
        $backend->assignRole('backend developer');
        $mobile->assignRole('mobile developer');
        $uiux->assignRole('UI/UX designer');
    }
}
