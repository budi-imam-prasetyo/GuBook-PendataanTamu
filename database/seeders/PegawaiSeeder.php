<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        Pegawai::create(['name' => 'John Doe']);
        Pegawai::create(['name' => 'Jane Smith']);
        Pegawai::create(['name' => 'Robert Johnson']);
        Pegawai::create(['name' => 'Michael Brown']);
        Pegawai::create(['name' => 'Jennifer Davis']);
        Pegawai::create(['name' => 'William Martinez']);
    }
}