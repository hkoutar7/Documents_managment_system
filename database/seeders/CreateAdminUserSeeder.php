<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Hamza Koutar',
            'email' => 'hamzakoutar@gmail.com',
            'password' => Hash::make('123456789@Bc'),
            'isActive' => 1,
            'email_verified_at' => now(),
            'role_names' => ['Owner'],
        ]);

        $role = Role::create(['name' => 'Owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
