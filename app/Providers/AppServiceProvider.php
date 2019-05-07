<?php

namespace App\Providers;

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
        //
        /*  Begin
        ================================================================================================
            https://eloquentbyexample.com/course/lesson/lesson-12-relationship-queries
            Dapat dari website ini 
            untuk metrigger sql event kita
        */
        // \DB::listen(function ($event) {
        //     // dump($event);
        //     dump($event->sql);
        //     dump($event->bindings);
        //     dump($event->time);
        // });
        /*  End
        ================================================================================================
        */

    }
}
