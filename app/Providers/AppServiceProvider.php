<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// gede tambahin biar enggak error ketika menggunakan maria db
use Illuminate\Support\Facades\Schema;
// gede
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // gede tambahin biar enggak error ketika menggunakan maria db
        Schema::defaultStringLength(191);
        // gede 
        //untuk mengubah lokasi waktu ke indonesia
        setlocale(LC_ALL, 'id');
        \Carbon\Carbon::setLocale('id');
        //untuk mengubah lokasi waktu ke indonesia
    }
}
