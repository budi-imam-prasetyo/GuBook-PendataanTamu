<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Akaunting\Apexcharts\Chart;
use App\Models\KedatanganEkspedisi;
use App\Models\KedatanganTamu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendEmail;
use App\Mail\SendEmailAccept;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use DNS2D;


class PegawaiController extends Controller
{
    private function hitungPersentaseKenaikan($nilaiSekarang, $nilaiSebelumnya)
    {
        if ($nilaiSebelumnya > 0) {
            return round((($nilaiSekarang - $nilaiSebelumnya) / $nilaiSebelumnya) * 100, 2);
        } elseif ($nilaiSekarang > 0) {
            return 100; // 100% increase if previous value was 0
        } else {
            return 0; // No change if both values are 0
        }
    }

    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $id_user = Auth::id();

        //! Tamu dan Kurir Hari Ini
        $tamuHariIni = KedatanganTamu::where('id_user', $id_user)->whereDate('waktu_perjanjian', Carbon::today())
            ->count();
        $kurirHariIni = KedatanganEkspedisi::where('id_user', $id_user)->whereDate('waktu_kedatangan', Carbon::today())
            ->count();

        //! Tamu dan Kurir Minggu Ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $tamuMingguIni = KedatanganTamu::where('id_user', $id_user)->whereBetween('waktu_perjanjian', [
            $startOfWeek,
            $endOfWeek
        ])->count();
        $kurirMingguIni = KedatanganEkspedisi::where('id_user', $id_user)->whereBetween('waktu_kedatangan', [
            $startOfWeek,
            $endOfWeek
        ])->count();
        $totalMingguIni = $tamuMingguIni + $kurirMingguIni;

        //! Tamu dan Kurir Bulan Ini
        $tamuBulanIni = KedatanganTamu::where('id_user', $id_user)->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->count();
        $kurirBulanIni = KedatanganEkspedisi::where('id_user', $id_user)->whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->count();
        $totalBulanIni = $tamuBulanIni + $kurirBulanIni;

        //! Tamu dan Kurir Bulan Lalu
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $tamuBulanLalu = KedatanganTamu::where('id_user', $id_user)->whereBetween('waktu_perjanjian', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        $kurirBulanLalu = KedatanganEkspedisi::where('id_user', $id_user)->whereBetween('waktu_kedatangan', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        $totalBulanLalu = $tamuBulanLalu + $kurirBulanLalu;
        // dd($totalBulanLalu, $totalBulanIni, $tamuBulanIni, $kurirBulanIni);
        //! Persentase
        if ($totalBulanLalu > 0) {
            $persentaseKenaikan = (($totalBulanIni - $totalBulanLalu) / $totalBulanLalu) * 100;
        } elseif ($totalBulanIni > 0) {
            $persentaseKenaikan = (($totalBulanIni - $totalBulanLalu) / $totalBulanIni) * 100;
        } else {
            $persentaseKenaikan = 1;
        }

        //! Tamu dan Kurir Minggu Lalu
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
        $tamuMingguLalu = KedatanganTamu::whereBetween('waktu_perjanjian', [$startOfLastWeek, $endOfLastWeek])->count();
        $kurirMingguLalu = KedatanganEkspedisi::whereBetween('waktu_kedatangan', [$startOfLastWeek, $endOfLastWeek])->count();
        $totalMingguLalu = $tamuMingguLalu + $kurirMingguLalu;

        //! Persentase Kenaikan Mingguan
        $persentaseKenaikanMingguan = $this->hitungPersentaseKenaikan($totalMingguIni, $totalMingguLalu);

        //! Tamu dan Kurir Hari Ini
        $tamuHariIni = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::today())->count();
        $kurirHariIni = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::today())->count();

        //! Tamu dan Kurir Kemarin
        $tamuKemarin = KedatanganTamu::whereDate('waktu_perjanjian', Carbon::yesterday())->count();
        $kurirKemarin = KedatanganEkspedisi::whereDate('waktu_kedatangan', Carbon::yesterday())->count();

        //! Persentase Kenaikan Harian
        $persentaseTamuHarian = $this->hitungPersentaseKenaikan($tamuHariIni, $tamuKemarin);
        $persentaseKurirHarian = $this->hitungPersentaseKenaikan($kurirHariIni, $kurirKemarin);

        //! Statistik Kedatangan
        if ($totalBulanLalu - $totalBulanIni == 0) {
            $statistik = 0;
        } else {
            $statistik = $totalBulanIni - $totalBulanLalu;
        }

        //! Dataset Grafik  
        $tamuPerHari = KedatanganTamu::selectRaw('DATE(waktu_perjanjian) as tanggal, COUNT(*) as jumlah')
            ->where('id_user', $id_user)
            ->whereBetween('waktu_perjanjian', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        $kurirPerHari = KedatanganEkspedisi::selectRaw('DATE(waktu_kedatangan) as tanggal, COUNT(*) as jumlah')
            ->where('id_user', $id_user)
            ->whereBetween('waktu_kedatangan', [$startOfMonth, $endOfMonth])
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        $datasetTamu = [];
        $datasetKurir = [];
        $labels = [];

        for ($tanggal = $startOfMonth->copy(); $tanggal <= $endOfMonth; $tanggal->addDay()) {
            $formatTanggal = $tanggal->format('Y-m-d');
            $labels[] = $tanggal->format('d');
            $datasetTamu[] = $tamuPerHari->get($formatTanggal, 0);
            $datasetKurir[] = $kurirPerHari->get($formatTanggal, 0);
        }

        //! View List Kunjungan Tamu dan Kurir
        $kedatanganTamu = KedatanganTamu::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'tamu';
            return $item;
        });
        $kedatanganKurir = KedatanganEkspedisi::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'kurir';
            return $item;
        });
        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');


        //! Chart
        $max = 2;
        $max = ($max < 10) ? $max : (($max < 20) ? 5 : 10);

        $chart = (new Chart)->setType('bar')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels($labels)
            ->setDataset('Tamu', 'bar', $datasetTamu)
            ->setDataset('Kurir', 'bar', $datasetKurir)
            ->setOptions(
                [
                    'yaxis' => [
                        'stepSize' => $max
                    ],
                    'colors' => ['#EF5F4C', '#CD5A36'],
                    'markers' => [
                        'colors' => [
                            '#EF5F4C',
                            '#CD5A36',
                        ],
                    ],
                    'stroke' => [
                        'colors' => [
                            '#EF5F4C',
                            '#CD5A36',
                        ]
                    ],

                ]
            );


        return view('pegawai.dashboard', compact(
            'chart',
            'totalBulanIni',
            'tamuHariIni',
            'kurirHariIni',
            'totalMingguIni',
            'kedatangan',
            'statistik',
            'persentaseKenaikan',
            'persentaseTamuHarian',
            'persentaseKurirHarian',
            'persentaseKenaikanMingguan'
        ));
    }

    public function laporanTamu(Request $request)
    {
        $requests = $request;
        $sort = $request->get('sort', 'nama_tamu');
        $direction = $request->get('direction', 'asc');
        $id_user = Auth::id();

        $query = KedatanganTamu::where('id_user', $id_user)->with(['tamu', 'user'])
            ->select('kedatangan_tamu.*')
            ->join('tamu', 'kedatangan_tamu.id_tamu', '=', 'tamu.id_tamu')
            ->join('users', 'kedatangan_tamu.id_user', '=', 'users.id')
            ->select('kedatangan_tamu.*', 'tamu.nama as nama_tamu', 'users.nama as nama_pegawai');

        // Gunakan when untuk menangani sorting
        $data = $query->when($sort === 'tamu.nama', function ($q) use ($direction) {
            return $q->orderBy('nama_tamu', $direction);
        }, function ($q) use ($sort, $direction) {
            return $q->orderBy($sort, $direction);
        })->paginate(10);

        // Iterate through the result set and add fotoUrl for each result

        // Apply date filters based on filter type
        if ($request->filled('filterType')) {
            switch ($request->filterType) {
                case 'daily':
                    if ($request->filled(['startDate', 'endDate'])) {
                        $query->whereBetween('kedatangan_tamu.waktu_perjanjian', [
                            Carbon::parse($request->startDate)->startOfDay(),
                            Carbon::parse($request->endDate)->endOfDay()
                        ]);
                    }
                    break;

                case 'monthly':
                    if ($request->filled(['month', 'monthYear'])) {
                        $startDate = Carbon::createFromDate($request->monthYear, $request->month, 1)->startOfMonth();
                        $endDate = $startDate->copy()->endOfMonth();
                        $query->whereBetween('kedatangan_tamu.waktu_perjanjian', [$startDate, $endDate]);
                    }
                    break;

                case 'yearly':
                    if ($request->filled('year')) {
                        $startDate = Carbon::createFromDate($request->year, 1, 1)->startOfYear();
                        $endDate = $startDate->copy()->endOfYear();
                        $query->whereBetween('kedatangan_tamu.waktu_perjanjian', [$startDate, $endDate]);
                    }
                    break;
                }
        }

        // Execute the query with sorting and pagination
        $data = $query->orderBy($sort, $direction)->paginate(10);

        // Transform data after query
        $data->through(function ($item) {
            if ($item->status === 'ditolak') {
                $item->status_display = 'Ditolak';
            } elseif ($item->status === 'menunggu') {
                $item->status_display = 'Belum Dikonfirmasi';
            } elseif (is_null($item->waktu_kedatangan) && Carbon::parse($item->waktu_perjanjian)->addHour()->isPast()) {
                $item->status_display = 'Tidak Datang';
            } elseif (
                !is_null($item->waktu_kedatangan) &&
                Carbon::parse($item->waktu_kedatangan)->lte(Carbon::parse($item->waktu_perjanjian)->addHour())
            ) {
                $item->status_display = 'Selesai';
            } elseif (is_null($item->waktu_kedatangan)) {
                $item->status_display = 'Belum Datang';
            } else {
                $item->status_display = $item->status;
            }
            return $item;
        });

        // Pass current filter values to the view
        $currentFilter = [
            'type' => $request->filterType,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'month' => $request->month,
            'monthYear' => $request->monthYear,
            'year' => $request->year,
        ];

        $nullFoto = asset('assets/user.jpg');


        return view('pegawai.laporanTamu', compact('data', 'sort', 'direction', 'requests', 'currentFilter', 'nullFoto'));
    }

    public function laporanKurir(Request $request)
    {
        $requests = $request;
        $sort = $request->get('sort', 'nama_kurir');
        $direction = $request->get('direction', 'asc');
        $id_user = Auth::id();


        $query = KedatanganEkspedisi::where('id_user', $id_user)->with(['ekspedisi', 'user'])
            ->select('kedatangan_ekspedisi.*')
            ->join('ekspedisi', 'kedatangan_ekspedisi.id_ekspedisi', '=', 'ekspedisi.id_ekspedisi')
            ->join('users', 'kedatangan_ekspedisi.id_user', '=', 'users.id')
            ->select('kedatangan_ekspedisi.*', 'ekspedisi.nama_kurir as nama_kurir', 'users.nama as nama_pegawai');

        // Gunakan when untuk menangani sorting
        $data = $query->when($sort === 'tamu.nama', function ($q) use ($direction) {
            return $q->orderBy('nama_kurir', $direction);
        }, function ($q) use ($sort, $direction) {
            return $q->orderBy($sort, $direction);
        })->paginate(10);

        // Iterate through the result set and add fotoUrl for each result

        // Apply date filters based on filter type
        if ($request->filled('filterType')) {
            switch ($request->filterType) {
                case 'daily':
                    if ($request->filled(['startDate', 'endDate'])) {
                        $query->whereBetween('kedatangan_ekspedisi.waktu_kedatangan', [
                            Carbon::parse($request->startDate)->startOfDay(),
                            Carbon::parse($request->endDate)->endOfDay()
                        ]);
                    }
                    break;

                case 'monthly':
                    if ($request->filled(['month', 'monthYear'])) {
                        $startDate = Carbon::createFromDate($request->monthYear, $request->month, 1)->startOfMonth();
                        $endDate = $startDate->copy()->endOfMonth();
                        $query->whereBetween('kedatangan_ekspedisi.waktu_kedatangan', [$startDate, $endDate]);
                    }
                    break;

                case 'yearly':
                    if ($request->filled('year')) {
                        $startDate = Carbon::createFromDate($request->year, 1, 1)->startOfYear();
                        $endDate = $startDate->copy()->endOfYear();
                        $query->whereBetween('kedatangan_ekspedisi.waktu_kedatangan', [$startDate, $endDate]);
                    }
                    break;
            }
        }

        // Execute the query with sorting and pagination
        $data = $query->orderBy($sort, $direction)->paginate(10);

        // Pass current filter values to the view
        $currentFilter = [
            'type' => $request->filterType,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'month' => $request->month,
            'monthYear' => $request->monthYear,
            'year' => $request->year,
        ];

        $nullFoto = asset('assets/user.jpg');


        return view('pegawai.laporanKurir', compact('data', 'sort', 'direction', 'requests', 'currentFilter', 'nullFoto'));
    }

    public function searchKurir(Request $request)
    {
        $search = $request->get('query');

        $data = KedatanganEkspedisi::join('ekspedisi', 'kedatangan_ekspedisi.id_ekspedisi', '=', 'ekspedisi.id_ekspedisi')
            ->join('users', 'kedatangan_ekspedisi.id_user', '=', 'users.id')
            ->where(function ($query) use ($search) {
                $query->where('ekspedisi.nama_kurir', 'LIKE', "%{$search}%")
                    ->orWhere('ekspedisi.ekspedisi', 'LIKE', "%{$search}%")
                    ->orWhere('users.nama', 'LIKE', "%{$search}%")
                    ->orWhere('ekspedisi.no_telpon', 'LIKE', "%{$search}%");
            })
            ->select([
                'kedatangan_ekspedisi.id_kedatangan',
                'ekspedisi.nama_kurir',
                'users.nama as nama_pegawai',
                'ekspedisi.ekspedisi',
                'ekspedisi.no_telpon',
                'kedatangan_ekspedisi.waktu_kedatangan',
                'kedatangan_ekspedisi.foto'
            ])
            ->orderBy('kedatangan_ekspedisi.waktu_kedatangan', 'desc')
            ->get();

        return response()->json($data);
    }
    public function searchTamu(Request $request)
    {
        $search = $request->get('query');

        $data = KedatanganTamu::join('tamu', 'kedatangan_tamu.id_tamu', '=', 'tamu.id_tamu')
            ->join('users', 'kedatangan_tamu.id_user', '=', 'users.id')
            ->where(function ($query) use ($search) {
                $query->where('tamu.nama', 'LIKE', "%{$search}%")
                    ->orWhere('tamu.email', 'LIKE', "%{$search}%")
                    ->orWhere('users.nama', 'LIKE', "%{$search}%");
            })
            ->select([
                'kedatangan_tamu.*',
                'tamu.nama',
                'tamu.email',
                'tamu.no_telpon',
                'users.nama as pegawai'
            ])
            ->orderBy('kedatangan_tamu.waktu_perjanjian', 'desc')
            ->get();

        // Transform data untuk status
        $data->transform(function ($item) {
            if ($item->status === 'ditolak') {
                $item->status_display = 'Ditolak';
            } elseif ($item->status === 'menunggu') {
                $item->status_display = 'Belum Dikonfirmasi';
            } elseif (is_null($item->waktu_kedatangan) && Carbon::parse($item->waktu_perjanjian)->addHour()->isPast()) {
                $item->status_display = 'Tidak Datang';
            } elseif (
                !is_null($item->waktu_kedatangan) &&
                Carbon::parse($item->waktu_kedatangan)->lte(Carbon::parse($item->waktu_perjanjian)->addHour())
            ) {
                $item->status_display = 'Selesai';
            } elseif (is_null($item->waktu_kedatangan)) {
                $item->status_display = 'Belum Datang';
            } else {
                $item->status_display = $item->status;
            }

            return $item;
        });

        return response()->json($data);
    }

    public function kunjungan()
    {
        $id_user = Auth::id();

        $statusDiterima = KedatanganTamu::where('id_user', $id_user)->where('status', 'Diterima')->count();
        $statusDitolak = KedatanganTamu::where('id_user', $id_user)->where('status', 'Ditolak')->count();
        $statusMenunggu = KedatanganTamu::where('id_user', $id_user)->where('status', 'Menunggu')->count();

        // Membuat chart dengan data yang sudah dihitung
        $chart = (new Chart)->setType('donut')
            ->setWidth('100%')
            ->setHeight(180)
            ->setLabels(['Diterima', 'Ditolak', 'Menunggu'])
            ->setDataset('Teams', 'donut', [$statusDiterima, $statusDitolak, $statusMenunggu])
            ->setOptions([
                'legend' => [
                    'position' => 'bottom'
                ],
                'colors' => ['#EF5F4C', '#CD5A36'],
                'markers' => [
                    'colors' => [
                        '#EF5F4C',
                        '#CD5A36',
                    ],
                ],
                'stroke' => [
                    'colors' => [
                        '#EF5F4C',
                        '#CD5A36',
                    ]
                ],
                'yaxis' => [
                    'stepSize' => 1
                ],
            ]);

        $kedatanganTamu = KedatanganTamu::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'tamu';
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });

        $kedatanganKurir = KedatanganEkspedisi::all()->where('id_user', $id_user)->map(function ($item) {
            $item->type = 'kurir';
            $item->formatWaktu = Carbon::parse($item->waktu_kedatangan)->translatedFormat('l, d-m-Y H:i');
            return $item;
        });

        $kedatangan = $kedatanganTamu->merge($kedatanganKurir)->sortByDesc('waktu_kedatangan');

        return view('pegawai.kunjungan', compact('chart', 'kedatangan'));
    }

    public function getDetail($id_kedatangan)
    {
        $item = KedatanganTamu::find($id_kedatangan) ?? KedatanganEkspedisi::find($id_kedatangan);
        if ($item) {
            $item->formatWaktu = Carbon::parse($item->waktu_perjanjian ?? $item->waktu_kedatangan)->translatedFormat('H:i l, d-m-Y');
            $item->type = ['tamu', 'kurir'];
        }

        return view('components.pegawai.card_detail', compact('item'))->render();
    }
    public function updateStatus(Request $request)
    {
        // dd($request->all());
        $kunjungan = KedatanganTamu::findOrFail($request->id_kedatangan);
        $kunjungan->status = $request->status;
        $kunjungan->save();

        if ($request->status == 'diterima') {
            $qrCodePath = 'qrcodes/' . $kunjungan->id_kedatangan . '.png';
            $qrCodeData = base64_decode($kunjungan->qr_code);
            Storage::disk('public')->put($qrCodePath, $qrCodeData);
            $fullQrCodePath = public_path('storage/' . $qrCodePath);
            // Kirim email ketika kunjungan diterima
            Mail::send('mails.SendEmail', [
                'subject' => 'Kunjungan Diterima',
                'body' => 'Kunjungan Anda telah diterima. Berikut adalah QR code untuk keperluan kunjungan Anda.',
            ], function ($message) use ($kunjungan, $fullQrCodePath) {
                $message->to($kunjungan->tamu->email)
                    ->subject('Kunjungan Diterima')
                    ->attach($fullQrCodePath, [
                        'as' => 'qrcode.png',
                        'mime' => 'image/png',
                    ]);
            });
        } elseif ($request->status == 'ditolak') {
            // Kirim email ketika kunjungan ditolak
            Mail::send('mails.SendEmail', [
                'subject' => 'Kunjungan Ditolak',
                'body' => 'Kunjungan Anda telah ditolak. Alasan: ' . $request->alasan,
            ], function ($message) use ($kunjungan) {
                $message->to($kunjungan->tamu->email)
                    ->subject('Kunjungan Ditolak');
            });
        }
        return redirect()->back()->with('success', 'Status kunjungan berhasil diperbarui.');
    }


    public function ship()
    {
        $users = Pegawai::all();
        Mail::to('budiimamprsty@gmail.com')->send(new SendEmail($users));
        return 'oke';
    }
}
