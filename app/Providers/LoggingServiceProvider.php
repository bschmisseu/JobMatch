<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\services\utility\LoggerInterface', function ($app) {
            return new \App\services\utility\MyLogger();
        });
    }
    
    public function provides()
    {
        echo "Deffered true and i am here in provides()";
        return ['App\services\utility\LoggerInterface'];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
