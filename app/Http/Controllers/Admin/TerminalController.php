<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    public function index()
    {
        $terms = Terminal::latest()->get();
        return view('admin.terminals', ['terminals'=>$terms]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'destination_city' => 'required|string|max:255',
            'terminal_info'    => 'required|string|max:255',
        ]);

        // auto‑generate TJ001, TJ002...
        $count = Terminal::count()+1;
        $data['terminal_code'] = 'TJ'.str_pad($count,3,'0',STR_PAD_LEFT);

        Terminal::create($data);
        return redirect()->route('admin.terminals.index')
                         ->with('success','Destination added.');
    }

    public function show(Terminal $terminal)
    {
        return response()->json($terminal);
    }

    public function update(Request $request, Terminal $terminal)
    {
        $data = $request->validate([
            'destination_city' => 'required|string|max:255',
            'terminal_info'    => 'required|string|max:255',
        ]);
        $terminal->update($data);
        return redirect()->route('admin.terminals.index')
                         ->with('success','Destination updated.');
    }
}
