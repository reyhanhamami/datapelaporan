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
        if (Request::segment(1) == 'wakif') {
            $halaman = 'wakif';
        }
        if (Request::segment(1) == 'donasi' or Request::segment(1) == 'inputbuktitransfer') {
            $halaman = 'input';
        }
        if (Request::segment(1) == 'DataEdc' or Request::segment(1) == 'buktitransfer') {
            $halaman = 'DataEdc';
        }
        if (Request::segment(1) == 'verifikasiTransfer' or Request::segment(1) == 'tabledonasi') {
            $halaman = 'laporan';
        }

        // untuk ngelempar variabel $halaman menjadi variabel global
        view()->share('halaman', $halaman);
    }
}
