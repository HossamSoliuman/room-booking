<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        Validator::extend('date_time', function ($attribute, $value, $parameters, $validator) {
            $format = 'Y-m-d H:i:s';
            $parsed = date_parse_from_format($format, $value);
            return $parsed['error_count'] === 0 && $parsed['warning_count'] === 0;
        });
    }
}
