<?php

namespace App\Providers;

use App\Helpers\AlertHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('alert', function ($app) {
            return new AlertHelper($app['session'], $app['view']);
        });
    }
}
