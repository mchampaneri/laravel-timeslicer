<?php

namespace Mcodes\Timeslicer;

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
        {   require 'routes.php';
            $this->app->make('Mcodes\Timeslicer\TimeSlicerController');
        }
        $this->publishes([
                    __DIR__.'/model/' => app_path('/') ]);

        $this->publishes([
            realpath(__DIR__.'/migrations/') => $this->app->databasePath().'/migrations',
        ]);
        $this->publishes([
            __DIR__.'/resources/' => public_path('mcodes/timeslicer/resources'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/views', 'Timeslicer');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/mcodes/timeslicer'),
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
