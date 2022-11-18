<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        Schema::defaultStringLength(191); //Solved by increasing StringLength    

        // para hacer log de Sql

        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);
        if ($this->app->environment('local')) {
            DB::listen(function($query) {
                Log::info('Query: ' . $query->sql . PHP_EOL);
                Log::info($query->bindings);
            });
        }        
        // FIN para hacer log de Sql        

    }
}
