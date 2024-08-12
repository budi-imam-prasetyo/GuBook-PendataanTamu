<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Akaunting\Apexcharts\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;

class AdminController extends Controller
{
    public function index()
    {
        $chart = (new Chart)->setType('area')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 29, 22, 23, 24, 25, 26, 27, 28, 29, 30])
            ->setDataset('Tamu', 'area', [5, 8, 4, 9, 7, 8, 4, 10, 3, 9, 3, 9, 9, 3, 10, 12, 12, 9, 3, 6, 9, 7, 3, 10, 9, 7, 4, 9, 6, 7])
            ->setDataset('Kurir', 'area', [9, 3, 6, 8, 3, 10, 4, 7, 5, 4, 9, 5, 9, 12, 6, 12, 5, 7, 4, 9, 5, 5, 7, 6, 7, 9, 8, 4, 9, 8]);

        return view('admin.dashboard', compact('chart'));
    }
    public function pagination()
    {
        $listpegawai = Pegawai::paginate(10); // mengambil 10 data per halaman
        $listpegawai->withPath('/admin/pegawai');
        return view('admin.pegawai', compact('listpegawai'));
    }

    public function pegawai()
    {
        $listpegawai = Pegawai::all();
        return view('admin.pegawai', compact('listpegawai'));
    }


    public function storePegawai(Request $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
        ]);

        // Cek apakah user berhasil dibuat
        if ($user) {
            // Buat pegawai baru
            $pegawai = Pegawai::create([
                'id_user' => $user->id,
                'NIP' => $request->NIP,
                'no_telpon' => $request->no_telpon,
                'PTK' => $request->PTK,
            ]);

            return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil ditambahkan');
        }

        return redirect()->route('admin.pegawai')->with('error', 'Gagal menambahkan pegawai');
    }

    public function editPegawai($NIP)
    {
        $pegawai = Pegawai::find($NIP);

        if ($pegawai) {
            return view('admin.edit-pegawai', compact('pegawai'));
        }

        return redirect()->route('admin.pegawai')->with('error', 'Pegawai tidak ditemukan');
    }

    public function updateGuru(Request $request, $id)
    {
        // Debug data request
        // dd($request->all());

        $pegawai = Pegawai::where('NIP', $request->NIP)->first();

        if ($pegawai) {
            // Perbarui data pegawai
            $pegawai->no_telpon = $request->newNo_telpon;
            $pegawai->NIP = $request->newNIP;
            $pegawai->PTK = $request->newPTK;
            $pegawai->save();

            if ($pegawai->user) {
                $pegawai->user->nama = $request->newName;
                $pegawai->user->email = $request->newEmail;
                $pegawai->user->password = Hash::make($request->newPassword);
                $pegawai->user->save();
            }
            return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil diupdate');
        }
        return redirect()->route('admin.pegawai')->with('error', 'Gagal mengupdate pegawai');
    }


    public function deletePegawai($id)
    {
        // return $id;
        $pegawai = User::find($id);

        if ($pegawai) {
            $pegawai->delete();
            return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil dihapus');
        }

        return redirect()->route('admin.pegawai')->with('error', 'Pegawai tidak ditemukan');
    }

    public function export()
    {
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);


        try {
            Excel::import(new PegawaiImport, $request->file('file'));
            // dd($request->all());
            return redirect()->back()->with('success', 'Data pegawai berhasil diimport');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }




    public function kunjungan()
    {
        $chart = (new Chart)->setType('donut')
            ->setWidth('100%')
            ->setHeight(180)
            ->setLabels(['Diterima', 'Ditolak', 'Menunggu'])
            ->setDataset('Teams', 'donut', [44, 55, 41])
            ->setOptions([
                'legend' => [
                    'position' => 'bottom'
                ]
            ]);

        return view('admin.kunjungan', compact('chart'));
    }
    public function store(Request $request)
    {
        $qrCodeData = $request->input('qr_code_data');
        // Proses data QR code di sini
        return response()->json(['message' => 'QR Code processed successfully']);
    }
}
