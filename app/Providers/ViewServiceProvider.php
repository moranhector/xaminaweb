<?php

namespace App\Providers;
use App\Models\Deposito;
use App\Models\Cliente;
use App\Models\Cheque;
use App\Models\Artesano;
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
        View::composer(['remitos.fields'], function ($view) {
            $depositoItems = Deposito::pluck('nombre','id')->toArray();
            $view->with('depositoItems', $depositoItems);
        });
        View::composer(['remitos.fields'], function ($view) {
            $depositoItems = Deposito::pluck('nombre','id')->toArray();
            $view->with('depositoItems', $depositoItems);
        });
        View::composer(['existencias.fields'], function ($view) {
            $depositoItems = Deposito::pluck('nombre','id')->toArray();
            $view->with('depositoItems', $depositoItems);
        });
        View::composer(['existencias.fields'], function ($view) {
            $depositoItems = Deposito::pluck('nombre','id')->toArray();
            $view->with('depositoItems', $depositoItems);
        });
        View::composer(['facturas.fields'], function ($view) {
            $clienteItems = Cliente::pluck('nombre','id')->toArray();
            $view->with('clienteItems', $clienteItems);
        });
        View::composer(['recibos.fields'], function ($view) {
            $chequeItems = Cheque::pluck('numero','id')->toArray();
            $view->with('chequeItems', $chequeItems);
        });
        View::composer(['recibos.fields'], function ($view) {
            $artesanoItems = Artesano::pluck('nombre','id')->toArray();
            $view->with('artesanoItems', $artesanoItems);
        });
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