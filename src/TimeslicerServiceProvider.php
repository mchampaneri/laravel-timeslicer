<?php

namespace mchampaneri\timeslicer;

use Illuminate\Support\ServiceProvider;

class TimeslicerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Enabling The Routes And Controller To The Plugin
        if( !$this->app->routesAreCached() )
        {
            $this->app->make('mchampaneri\timeslicer\Model\Timeslice');
            require 'routes.php';
        }
      

        $this->publishes([
            realpath(__DIR__.'/migrations/') => $this->app->databasePath().'/migrations',
        ]);

        $this->publishes([
            __DIR__.'config.php' => config_path('timeslicer.php'),
        ]);



    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }


}
