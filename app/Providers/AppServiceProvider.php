<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Bus;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ...
    }

    public function boot()
    {
        // Whenever admin.buses renders, it will get a $buses variable
        View::composer('admin.buses', function ($view) {
            $view->with('buses', Bus::all());
        });
    }
}
