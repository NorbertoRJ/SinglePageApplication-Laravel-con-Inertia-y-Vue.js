<?php

namespace App\Providers;

use Inertia\Inertia; //trabajar con la vista de vue
use Illuminate\Support\Facades\Session; //permite trabajar con sesiones
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
        Inertia::share('flash',function(){
            return ['status' => Session::get('status')];
            //compartimos informacion entre php y el componente Interia para conectarme con vue
        });
    }
}
