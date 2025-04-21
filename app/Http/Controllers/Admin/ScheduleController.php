<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Terminal;
use App\Models\Bus;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $terminals = Terminal::orderBy('destination_city')->get();
        $buses     = Bus::orderBy('bus_name')->get();
        $schedules = Schedule::with(['origin','destination','bus'])->latest()->get();

        return view('admin.schedules', compact('terminals','buses','schedules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'origin_terminal_id'      => 'required|exists:terminals,id',
            'destination_terminal_id' => 'required|exists:terminals,id',
            'bus_id'                  => 'required|exists:buses,id',
            'departure_time'          => 'required|date_format:H:i',
            'arrival_time'            => 'required|date_format:H:i',
            'price'                   => 'required|numeric|min:0',
        ]);

        // code like J001, J002…
        $count = Schedule::count()+1;
        $data['schedule_code'] = 'J'.str_pad($count,3,'0',STR_PAD_LEFT);

        Schedule::create($data);

        return redirect()->route('admin.schedules.index')
                         ->with('success','Schedule added.');
    }

    public function show(Schedule $schedule)
    {
        // load relations for JSON
        $schedule->load(['origin','destination','bus']);
        return response()->json($schedule);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'origin_terminal_id'      => 'required|exists:terminals,id',
            'destination_terminal_id' => 'required|exists:terminals,id',
            'bus_id'                  => 'required|exists:buses,id',
            'departure_time'          => 'required|date_format:H:i',
            'arrival_time'            => 'required|date_format:H:i',
            'price'                   => 'required|numeric|min:0',
        ]);

        $schedule->update($data);

        return redirect()->route('admin.schedules.index')
                         ->with('success','Schedule updated.');
    }
    // app/Http/Controllers/Admin/ScheduleController.php

public function apiIndex(Request $request)
{
    $origin      = $request->query('origin');
    $destination = $request->query('destination');

    $schedules = Schedule::with('bus')
      ->where('origin_terminal_id', $origin)
      ->where('destination_terminal_id', $destination)
      ->whereHas('bus', fn($q)=>$q->where('status','Active'))
      ->get();

    return response()->json($schedules);
}
public function apiShow(Schedule $schedule)
{
    // eager‐load the bus (and origin/destination if you like)
    $schedule->load('bus','origin','destination');
    return response()->json($schedule);
}

}
