<?php
namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PegawaiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pegawai::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'NIP', 'Nama', 'Email', 'No Telpon', 'PTK', 'Created At', 'Updated At'
        ];
    }

    public function map($pegawai): array
    {
        return [
            $pegawai->NIP,
            $pegawai->user->nama,
            $pegawai->user->email,
            $pegawai->no_telpon,
            $pegawai->PTK,
            $pegawai->created_at,
            $pegawai->updated_at,
        ];
    }
}