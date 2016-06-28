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
        {   $this->app->make('mchampaneri\timeslicer\Controller\TimeSlicerController');
            $this->app->make('mchampaneri\timeslicer\Model\Timeslice');
            require 'routes.php';
        }
        $this->publishes([
                    __DIR__.'/model/' => app_path('/mchampaneri/timeslicer') ]);

        $this->publishes([
            realpath(__DIR__.'/migrations/') => $this->app->databasePath().'/migrations',
        ]);
        $this->publishes([
            __DIR__.'/resources/' => public_path('mchampaneri/timeslicer/assets/'),
        ], 'public');

//        $this->loadViewsFrom(__DIR__.'/views', 'Timeslicer');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/mchampaneri/timeslicer'),
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
