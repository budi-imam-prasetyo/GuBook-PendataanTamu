<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Log data yang diterima dari file Excel
        Log::info('Data yang diimpor:', $row);
        $user = User::updateOrCreate(
            ['email' => $row['email']],
            [
                'nama' => $row['nama'],
                'password' => Hash::make('defaultpassword'), // Atur password default atau lakukan logika lain
                'role' => 'pegawai'
            ]
        );

        // Periksa apakah semua kolom yang diperlukan ada di data impor
        if (empty($row['nip']) || empty($row['no_telpon']) || empty($row['ptk'])) {
            return null; // Abaikan baris yang tidak lengkap
        }

        return new Pegawai([
            'NIP'       => $row['nip'],
            'id_user'   => $user->id,
            'no_telpon' => $row['no_telpon'],
            'PTK'       => $row['ptk'],
        ]);
    }
}