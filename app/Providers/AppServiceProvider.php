<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Bus;
use App\Models\Schedule;
use App\Models\Terminal;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ...
    }

    public function boot()
    { 
        View::composer('admin.schedules', function ($view) {
            $view->with('terminals', Terminal::all())
                 ->with('buses',      Bus::all())
                 ->with('schedules', Schedule::all());
        });
        // Every time the 'admin.terminals' view is rendered,
        // it will receive a $terminals variable containing all Terminal records.
        View::composer('admin.terminals', function ($view) {
            $view->with('terminals', Terminal::all());
        });
        
        // If you’d like it available across all admin views, you could instead use:
        // View::composer('admin.*', fn($view) => $view->with('terminals', Terminal::all()));
        // Whenever admin.buses renders, it will get a $buses variable
        View::composer('admin.buses', function ($view) {
            $view->with('buses', Bus::all());
            
        });
    }
 

}
