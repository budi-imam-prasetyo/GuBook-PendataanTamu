<?php

use Livewire\Volt\Volt;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FOController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//* ROUTE USER
Route::get('/welcome', function () {
    $string = 'Hello World!';
    $qrcode = QrCode::generate($string);
    return view('user.welcome')->with('qrcode', $qrcode);
})->name('welcome');
Route::get('/', function () {
    return redirect('/welcome'); //* redirect to welcome
});
Route::get('/register', function () {
    return redirect('/login'); //* redirect to login
});

//? FORM TAMU
Route::get('/form-tamu', [UserController::class, 'formTamu'])->name('tamu');
Route::post('/store/tamu', [UserController::class, 'storeTamu'])->name('tamu.store');
//? FORM KURIR
Route::get('/form-kurir', [UserController::class, 'formKurir'])->name('kurir');
Route::post('/store/kurir', [UserController::class, 'storeKurir'])->name('kurir.store');
//? LIST PEGAWAI DAN TENTANG
Route::get('/list-pegawai', [UserController::class, 'listPegawai']);
Route::get('/tentang', [UserController::class, 'about']);
Route::post('/check-appointments', [UserController::class, 'checkAppointments']);
//* ROUTE USER


//* ROUTE ADMIN
Route::middleware(['checkRole:superadmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        //? DASHBOARD
        Route::get('/', [AdminController::class, 'index']);
        //? PEGAWAI
        Route::get('/pegawai', [AdminController::class, 'pegawai'])->name('admin.pegawai');
        Route::post('/store/pegawai', [AdminController::class, 'storePegawai'])->name('admin.store.pegawai');
        Route::delete('/pegawai/{NIP}', [AdminController::class, 'deletePegawai'])->name('admin.pegawai.delete');
        Route::get('/pegawai/{NIP}/edit', [AdminController::class, 'editPegawai'])->name('admin.pegawai.edit');
        Route::post('/pegawai/update/{id}', [AdminController::class, 'updateGuru'])->name('admin.pegawai.update');
        Route::get('pegawai/export/', [AdminController::class, 'export'])->name('pegawai.export');
        Route::post('pegawai/import/', [AdminController::class, 'import'])->name('pegawai.import');
        //? KUNJUNGAN
        Route::get('/kunjungan', [AdminController::class, 'kunjungan'])->name('admin.kunjungan');
        Route::get('/kunjungan/{id_kedatangan}', [AdminController::class, 'getDetail']);
        Route::post('/scan-result', [AdminController::class, 'store']);
    });
});
//* ROUTE ADMIN

//* ROUTE PEGAWAI
    Route::middleware(['checkRole:pegawai'])->group(function () {
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'index']);
            Route::get('/kunjungan', [PegawaiController::class, 'kunjungan'])->name('pegawai.kunjungan');
            Route::get('/kunjungan/{id_kedatangan}', [PegawaiController::class, 'getDetail']);
            Route::get('/send-email', [PegawaiController::class, 'ship'])->name('send.email');
            Route::post('/kunjungan/status/update', [PegawaiController::class, 'updateStatus'])->name('status.update');
        });
    });
//* ROUTE PEGAWAI

//* ROUTE FO
Route::middleware(['checkRole:FO'])->group(function () {
    Route::prefix('FO')->group(function () {
        Route::match(['get', 'post'], '/', [FOController::class, 'index']);
        Route::get('/pegawai', [FOController::class, 'pegawai'])->name('FO.pegawai');
        Route::post('/pegawai/post', [FOController::class, 'pegawaiPost'])->name('FO.pegawai.post');
        Route::get('/tamu-detail/{id_kedatangan}', [FOController::class, 'getTamuDetail'])->name('tamu.Detail');
        Route::post('/update-kunjungan', [FOController::class, 'updateKedatangan'])->name('update-kedatangan');
        Route::get('/laporan-tamu', [FOController::class, 'laporanTamu'])->name('FO.laporanTamu');
        Route::get('/laporan-kurir', [FOController::class, 'laporanKurir'])->name('FO.laporanKurir');
        Route::get('/search-tamu', [FOController::class, 'searchTamu'])->name('search.tamu');
        Route::get('/search-kurir', [FOController::class, 'searchKurir'])->name('search.kurir');
        Route::get('/filter-tamu', [FOController::class, 'filterTamu'])->name('filter.tamu');
        Route::get('/kunjungan', [FOController::class, 'kunjungan'])->name('FO.kunjungan');
        Route::get('/kunjungan/{id_kedatangan}', [FOController::class, 'getDetail']);
    });
});
//* ROUTE FO

Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// view()->share('title', 'Beranda');