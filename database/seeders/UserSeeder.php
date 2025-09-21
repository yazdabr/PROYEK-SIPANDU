<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'TMB', 'email' => 'tmb@example.com', 'role' => 'TMB'],
            ['name' => 'SIARAN', 'email' => 'siaran@example.com', 'role' => 'SIARAN'],
            ['name' => 'LPU', 'email' => 'lpu@example.com', 'role' => 'LPU'],
            ['name' => 'KMB', 'email' => 'kmb@example.com', 'role' => 'KMB'],
            ['name' => 'TATA USAHA KEUANGAN', 'email' => 'tuk@example.com', 'role' => 'TATA USAHA KEUANGAN'],
            ['name' => 'TATA USAHA UMUM', 'email' => 'tuu@example.com', 'role' => 'TATA USAHA UMUM'],
            ['name' => 'TATA USAHA SDM', 'email' => 'tusdm@example.com', 'role' => 'TATA USAHA SDM'],
            ['name' => 'Operator PPID', 'email' => 'ppid@example.com', 'role' => 'Operator PPID'],
            ['name' => 'Manajemen', 'email' => 'manajemen@example.com', 'role' => 'Manajemen'],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']], // cek kalau sudah ada email tidak duplikat
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'), // default password
                    'role' => $data['role']
                ]
            );
        }
    }
}
