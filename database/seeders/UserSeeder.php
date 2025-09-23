<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'User TMB',
            'email' => 'uptmb@gmail.com',
            'password' => Hash::make('teknik123'),
            'role' => 'tmb',
        ]);

        User::create([
            'name' => 'Operator PPID',
            'email' => 'ppid@gmail.com',
            'password' => Hash::make('ppid123'),
            'role' => 'ppid',
        ]);
    }
}
