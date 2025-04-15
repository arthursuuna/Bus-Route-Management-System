<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



// routes/web.php
Route::get('/', [HomeController::class, 'index'])->name('home');


// Route::get('about-us',[MainController::class,'about_us'])->name('about');;

// Route::get('about-us', function () {
//     return route('about'); 
// });

// Route::get('details', function () {
//     return 'this is about us';
// })->name('about');