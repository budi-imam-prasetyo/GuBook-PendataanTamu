<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $names = [
            'Adi', 'Budi', 'Cici', 'Dedi', 'Evi', 'Fani', 'Gani', 'Hani', 
            'Ika', 'Joko', 'Kiki', 'Lina', 'Mira', 'Nina', 'Oni'
        ];

        $subjects = [
            'Matematika', 'Bahasa Inggris', 'Bahasa Indonesia', 
            'Fisika', 'Kimia', 'Biologi', 'Ekonomi', 'Geografi', 
            'Sejarah', 'Sosiologi', 'Pendidikan Jasmani', 'Teknik Mesin', 
            'Teknik Elektro', 'Teknik Informatika', 'Teknik Sipil'
        ];

        $pegawais = [];

        for ($i = 0; $i < 15; $i++) {
            $pegawais[] = [
                'name' => $names[$i],
                'no_telpon' => '0812' . rand(10000000, 99999999),
                'NIP' => 'NIP' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                'PTK' => $subjects[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pegawais')->insert($pegawais);
    }
}