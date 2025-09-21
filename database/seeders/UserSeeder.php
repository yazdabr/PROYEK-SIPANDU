<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'TMB', 'email' => 'tmb@sipandu.local', 'role' => 'TMB'],
            ['name' => 'SIARAN', 'email' => 'siaran@sipandu.local', 'role' => 'SIARAN'],
            ['name' => 'KMB', 'email' => 'kmb@sipandu.local', 'role' => 'KMB'],
            ['name' => 'LPU', 'email' => 'lpu@sipandu.local', 'role' => 'LPU'],
            ['name' => 'Tata Usaha Keuangan', 'email' => 'tuk@sipandu.local', 'role' => 'TATA USAHA KEUANGAN'],
            ['name' => 'Tata Usaha Umum', 'email' => 'tuu@sipandu.local', 'role' => 'TATA USAHA UMUM'],
            ['name' => 'Tata Usaha SDM', 'email' => 'tusdm@sipandu.local', 'role' => 'TATA USAHA SDM'],
            ['name' => 'Operator PPID', 'email' => 'ppid@sipandu.local', 'role' => 'Operator PPID'],
            ['name' => 'Manajemen', 'email' => 'manajemen@sipandu.local', 'role' => 'Manajemen'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'role' => $u['role'],
                'password' => Hash::make('password123'), // default password
            ]);
        }
    }
}

