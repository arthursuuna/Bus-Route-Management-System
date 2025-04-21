<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PassController extends Controller
{
    /** Display form + list */
    public function index()
    {
        $terminals = Terminal::orderBy('destination_city')->get();
        $passes    = Pass::with('schedule.origin','schedule.destination','schedule.bus')
                         ->where('user_id', Auth::id())
                         ->latest()
                         ->get();

        return view('passes', compact('terminals','passes'));
    }

    /** Handle new pass submission */
    public function store(Request $request)
    {
        $data = $request->validate([
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'schedule_id'  => 'required|exists:schedules,id',
        ]);

        // generate Pass code
        $count = Pass::count() + 1;
        $data['pass_code'] = 'P' . str_pad($count, 4, '0', STR_PAD_LEFT);

        $data['user_id'] = Auth::id();

        Pass::create($data);

        return redirect()->route('passes')
                         ->with('success', "Thank you! Your Pass ID is {$data['pass_code']}.");
    }

    /** Return pass + relations as JSON for the modal */
    public function show(Pass $pass)
    {
        abort_if($pass->user_id !== Auth::id(), 403);

        $pass->load('user','schedule.origin','schedule.destination','schedule.bus');

        return response()->json($pass);
    }
    /**
 * Generate & return a PDF of the pass.
 */


}
