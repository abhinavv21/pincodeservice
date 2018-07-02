<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\PinService;


class PinServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\PinService', function ($app) {
            return new PinService();
        });
    }
}
