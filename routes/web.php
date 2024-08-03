<?php

use Livewire\Volt\Volt;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

//? ROUTE USER
Route::get('/welcome', function () {
    return view('user.welcome');
});
Route::get('/', function () {
    return redirect('/welcome'); //* redirect to welcome
});
Route::get('/register', function () {
    return redirect('/login'); //* redirect to login
});
Route::get('/form-tamu', [UserController::class, 'formTamu']);
Route::get('/form-kurir', [UserController::class, 'formKurir']);
Route::get('/list-pegawai', [UserController::class, 'listPegawai']);
Route::get('/pegawai/load', [UserController::class, 'loadlist']);
Route::get('/pegawai/search', [UserController::class, 'search']);
Route::get('/tentang', [UserController::class, 'about']);
//? ROUTE USER

//! ROUTE ADMIN
Route::middleware(['checkRole:superadmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        // Route::get('/chart-data', [ChartController::class, 'index']);
        Route::get('/pegawai', [AdminController::class, 'pagination'])->name('admin.pegawai');
        Route::post('/store/pegawai', [AdminController::class, 'storePegawai'])->name('admin.store.pegawai');
        Route::delete('/pegawai/{id}', [AdminController::class, 'deletePegawai'])->name('admin.pegawai.delete');
        Route::get('/pegawai/{id}/edit', [AdminController::class, 'editPegawai'])->name('admin.pegawai.edit');
        Route::post('/pegawai/update/{id}', [AdminController::class, 'updateGuru'])->name('admin.pegawai.update');
        Route::get('/pegawai/search', [AdminController::class, 'search'])->name('pegawai.search');
        Route::get('pegawai/export/', [AdminController::class, 'export'])->name('pegawai.export');
        Route::post('pegawai/import/', [AdminController::class, 'import'])->name('pegawai.import');
        Route::get('/kunjungan', [AdminController::class, 'kunjungan']);
    });
    Route::post('/scan-result', [AdminController::class, 'store']);
});
//! ROUTE ADMIN

//* ROUTE PEGAWAI
Route::middleware(['role:pegawai'])->group(function () {
    Route::prefix('pegawai')->group(function () {
        Route::get('/', [PegawaiController::class, 'index']);
    });
});
//* ROUTE PEGAWAI


Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// view()->share('title', 'Beranda');