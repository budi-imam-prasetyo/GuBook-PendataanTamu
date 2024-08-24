<?php

use Livewire\Volt\Volt;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//? ROUTE USER
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
// ROUTE FORM TAMU
Route::get('/form-tamu', [UserController::class, 'formTamu'])->name('tamu');
Route::post('/store/tamu', [UserController::class, 'storeTamu'])->name('tamu.store');
// ROUTE FORM KURIR
Route::get('/form-kurir', [UserController::class, 'formKurir'])->name('kurir');
Route::post('/store/kurir', [UserController::class, 'storeKurir'])->name('kurir.store');
// ROUTE LIST PEGAWAI DAN TENTANG
Route::get('/list-pegawai', [UserController::class, 'listPegawai']);
Route::get('/tentang', [UserController::class, 'about']);
//? ROUTE USER


//! ROUTE ADMIN
Route::middleware(['checkRole:superadmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        // Route::get('/chart-data', [ChartController::class, 'index']);
        Route::get('/pegawai', [AdminController::class, 'pagination'])->name('admin.pegawai');
        Route::post('/store/pegawai', [AdminController::class, 'storePegawai'])->name('admin.store.pegawai');
        Route::delete('/pegawai/{NIP}', [AdminController::class, 'deletePegawai'])->name('admin.pegawai.delete');
        Route::get('/pegawai/{NIP}/edit', [AdminController::class, 'editPegawai'])->name('admin.pegawai.edit');
        Route::post('/pegawai/update/{id}', [AdminController::class, 'updateGuru'])->name('admin.pegawai.update');
        Route::get('/pegawai/search', [AdminController::class, 'search'])->name('pegawai.search');
        Route::get('pegawai/export/', [AdminController::class, 'export'])->name('pegawai.export');
        Route::post('pegawai/import/', [AdminController::class, 'import'])->name('pegawai.import');
        Route::get('/kunjungan', [AdminController::class, 'kunjungan']);
        Route::get('/kunjungan/{id_kedatangan}', [AdminController::class, 'getDetail']);
    Route::post('/scan-result', [AdminController::class, 'store']);
});
        
    });
//! ROUTE ADMIN

//* ROUTE PEGAWAI
Route::middleware(['chechRole:pegawai'])->group(function () {
    Route::prefix('pegawai')->group(function () {
        Route::get('/', [PegawaiController::class, 'index']);
    });
});
//* ROUTE PEGAWAI


Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// view()->share('title', 'Beranda');