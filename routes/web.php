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

Route::get('/custom-qrcode', function () {
    return QrCode::size(300)->color(255, 0, 0)->generate('https://example.com');
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
        Route::get('/kunjungan', [AdminController::class, 'kunjungan']);
        Route::get('/kunjungan/{id_kedatangan}', [AdminController::class, 'getDetail']);
        Route::post('/scan-result', [AdminController::class, 'store']);
    });
});
//* ROUTE ADMIN

//* ROUTE PEGAWAI
    Route::middleware(['checkRole:pegawai'])->group(function () {
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'index']);
            Route::get('/kunjungan', [PegawaiController::class, 'kunjungan']);
            Route::get('/kunjungan/{id_kedatangan}', [PegawaiController::class, 'getDetail']);
            Route::post('/kunjungan/status/update', [PegawaiController::class, 'updateStatus'])->name('status.update');
        });
    });
//* ROUTE PEGAWAI

//* ROUTE FO
Route::middleware(['checkRole:FO'])->group(function () {
    Route::prefix('FO')->group(function () {
        Route::get('/', [FOController::class, 'index']);
    });
});
//* ROUTE FO


Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// view()->share('title', 'Beranda');