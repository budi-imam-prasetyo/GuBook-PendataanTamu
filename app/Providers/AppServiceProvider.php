<?php

namespace App\Providers;

use App\Http\Livewire\SearchPegawai;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('search-pegawai', SearchPegawai::class);
        Paginator::defaultView('components.pagination');

    }
}