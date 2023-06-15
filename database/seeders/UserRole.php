<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        
        DB::beginTransaction();
        
        try {
            $user = User::create(array_merge([
                'email' => 'user@gmail.com',
                'name' => 'User',
                'role' => 'user',
                'phone_number' => '081242067383',
            ], $default_user_value));
    
            $admin = User::create(array_merge([
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'role' => 'admin',
                'phone_number' => '081242067383',
            ], $default_user_value));
    
            $manager = User::create(array_merge([
                'email' => 'manager@gmail.com',
                'name' => 'Manager',
                'role' => 'manager',
                'phone_number' => '081242067383',
            ], $default_user_value));
    
            $profile = Profile::create([
                'user_id' => $user->user_id,
            ]);
    
            $profile = Profile::create([
                'user_id' => $admin->user_id,
            ]);
    
            $profile = Profile::create([
                'user_id' => $manager->user_id,
            ]);
    
            $role_user = Role::create(['name' => 'user']);
            $role_admin = Role::create(['name' => 'admin']);
            $role_manager = Role::create(['name' => 'manager']);
    
            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);
    
            $role_user->givePermissionTo('read role');
            $role_admin->givePermissionTo('read role', 'create role', 'update role');
            $role_manager->givePermissionTo('read role', 'create role', 'update role', 'delete role');
    
            $user->assignRole('user');
            $admin->assignRole('admin');
            $manager->assignRole('manager');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
