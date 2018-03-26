<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Holiday\Finder;
use App\Helpers\Holiday\ArrayHolidaysData;

class ArrayHolidayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Finder::class, function() {
            return new Finder(new ArrayHolidaysData());
        });
    }
}
