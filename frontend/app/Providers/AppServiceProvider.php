<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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
        // Blade::withoutDoubleEncoding();
        date_default_timezone_set(env('APP_TIMEZONE','Asia/Jakarta'));
        setlocale(LC_ALL, 'IND');
        // dd(Carbon::now()->formatLocalized('%A %d %B %Y'));
        // dd(Carbon::now());
    }
}
