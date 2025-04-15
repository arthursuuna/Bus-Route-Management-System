<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   // app/Http/Controllers/HomeController.php
public function index() {
    return view('home');
}

}
