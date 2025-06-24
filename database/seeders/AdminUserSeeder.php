<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@framex.com',
            'password' => Hash::make('12345678'),
        ]);

        $adminRole = Role::where('slug', 'admin')->first();
        $admin->roles()->attach($adminRole);
    }
}
