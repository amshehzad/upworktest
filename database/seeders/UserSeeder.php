<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@system.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('Admin');
    }
}
