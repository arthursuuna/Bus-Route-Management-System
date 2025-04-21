<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show the list of all terminals (city & terminal info).
     */
    public function index()
    {
        $terminals = Terminal::orderBy('destination_city')->get();
        return view('tickets', compact('terminals'));
    }
}
