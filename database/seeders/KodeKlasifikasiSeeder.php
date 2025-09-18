<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodeKlasifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'PR'],
            ['kode' => 'PW'],
            ['kode' => 'UM'],
            ['kode' => 'KP'],
            ['kode' => 'KU'],
            ['kode' => 'PL'],
            ['kode' => 'HK'],
            ['kode' => 'OT'],
            ['kode' => 'KS'],
            ['kode' => 'HM'],
            ['kode' => 'PB'],
            ['kode' => 'DT'],
            ['kode' => 'LT'],
            ['kode' => 'STO'],
            ['kode' => 'TX'],
            ['kode' => 'IT'],
            ['kode' => 'PPS'],
            ['kode' => 'PPP'],
            ['kode' => 'KJM'],
        ];

        DB::table('kodeklasifikasi')->insert($data);
    }
}
