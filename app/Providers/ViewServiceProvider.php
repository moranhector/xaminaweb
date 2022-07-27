<?php

namespace App\Providers;
use App\Models\Rubro;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['tipopiezas.fields'], function ($view) {
            $rubroItems = Rubro::pluck('descrip','id')->toArray();
            $view->with('rubroItems', $rubroItems);
        });
        // View::composer(['tipopiezas.fields'], function ($view) {
        //     $rubroItems = Rubro::pluck('descrip','id')->toArray();
        //     $view->with('rubroItems', $rubroItems);
        // });
        // View::composer(['tipopiezas.fields'], function ($view) {
        //     $rubroItems = Rubro::pluck('descrip','id')->toArray();
        //     $view->with('rubroItems', $rubroItems);
        // });
        //
    }
}