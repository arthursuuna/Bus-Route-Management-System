<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\TerminalController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PassController;

// routes/web.php

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Placeholder user dashboard (we’ll build it later)
Route::get('/dashboard', function () {
    return view('dashboard'); // create this view as a placeholder
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/ terminals', [AdminController::class, 'terminals'])->name('admin.terminals');
    Route::get('/ schedules', [AdminController::class, 'schedules'])->name('admin.schedules');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
    Route::get('/bus', [AdminController::class, 'buses'])->name('admin.buses');
});
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/terminals', [AdminController::class, 'terminals'])->name('admin.terminals');

// Bus management (all in one blade)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/buses',       [BusController::class,'index']) ->name('buses.index');
    Route::post('/buses',      [BusController::class,'store']) ->name('buses.store');
    Route::get('/buses/{bus}', [BusController::class,'show'])  ->name('buses.show');
});
Route::put('/admin/buses/{bus}', [BusController::class,'update'])
     ->name('admin.buses.update')
     ->middleware('auth');
     

     // Terminal (destinations) management
     Route::get  ('/admin/terminals',        [TerminalController::class,'index']) ->name('admin.terminals.index');
     Route::post ('/admin/terminals',        [TerminalController::class,'store']) ->name('admin.terminals.store');
     Route::get  ('/admin/terminals/{terminal}', [TerminalController::class,'show'])  ->name('admin.terminals.show');
     Route::put  ('/admin/terminals/{terminal}', [TerminalController::class,'update'])->name('admin.terminals.update');

     

Route::get ('/admin/schedules',            [ScheduleController::class,'index']) ->name('admin.schedules.index');
Route::post('/admin/schedules',            [ScheduleController::class,'store']) ->name('admin.schedules.store');
Route::get ('/admin/schedules/{schedule}', [ScheduleController::class,'show'])  ->name('admin.schedules.show');
Route::put ('/admin/schedules/{schedule}', [ScheduleController::class,'update'])->name('admin.schedules.update');

     


// Profile view/edit
Route::get('/profile', [ProfileController::class,'edit'])
     ->name('profile');

Route::put('/profile', [ProfileController::class,'update'])
     ->name('profile.update');
    


    // … other user routes …

    // Passes listing page
 
    // ... other user routes ...
    
    // AJAX endpoint to fetch schedules
    Route::get('/api/schedules', [ScheduleController::class,'apiIndex'])
         ->middleware('auth');
        

Route::get('/api/schedules/{schedule}', [ScheduleController::class,'apiShow'])
     ->middleware('auth');

    
    // Passes
    

   
        Route::middleware('auth')->group(function () {
            Route::get('/passes',  [PassController::class,'index'])->name('passes');
            Route::post('/passes', [PassController::class,'store'])->name('passes.store');
            Route::get('/passes/{pass}', [PassController::class,'show'])
            ->name('passes.show');
        });
        
       

        Route::middleware('auth')->group(function(){
            // … existing passes routes …
        
            // PDF download endpoint
            Route::get('/passes/{pass}/download', [PassController::class,'download'])
                 ->name('passes.download');
        });
        

Route::middleware('auth')->group(function(){
    // … other user routes …

    // Tickets listing
    Route::get('/tickets', [TicketController::class,'index'])
         ->name('tickets');
});

        
       


