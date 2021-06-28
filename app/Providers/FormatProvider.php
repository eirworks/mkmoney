<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class FormatProvider extends ServiceProvider
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
        Str::macro('currency', function($number, $currency = "") {
            return $currency.number_format($number, 2, ',', '.');
        });

        Carbon::macro('simpleDate', function($str) {
            return Carbon::parse($str)->format('d M Y');
        });

        Carbon::macro('simpleDatetime', function($str, $withSecond = false) {
            return Carbon::parse($str)->format('d M Y H:i'.($withSecond ? ':s' : ''));
        });
    }
}
