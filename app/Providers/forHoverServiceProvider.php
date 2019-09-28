<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class forHoverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $halaman = '';
        if (Request::segment(1) == 'home') {
            $halaman = 'home';
        }
        if (Request::segment(1) == 'keuangan') {
            $halaman = 'keuangan';
        }
        if (Request::segment(1) == 'barang'){
            $halaman = 'barang';
        }
        if (Request::segment(1) == 'customer'){
            $halaman = 'customer';
        }
        if(Request::segment(1) == 'vendor'){
            $halaman = 'vendor';
        }
        if (Request::segment(1) == 'expedisi'){
            $halaman = 'expedisi';
        }
        if (Request::segment(1) == 'ecommerce'){
            $halaman = 'ecommerce';
        }
        if (Request::segment(1) == 'reseller'){
            $halaman = 'reseller';
        }

        // untuk ngelempar variabel $halaman menjadi variabel global
        view()->share('halaman', $halaman);
    }
}
