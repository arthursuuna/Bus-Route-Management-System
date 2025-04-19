<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::orderBy('created_at','desc')->get();
        return view('admin.buses', compact('buses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bus_name'      => 'required|string|max:255',
            'bus_plate'     => 'required|string|unique:buses,bus_plate',
            'seat_capacity' => 'required|integer|min:1',
            'status'        => 'required|in:Active,Inactive',
        ]);

        // auto‑generate code B001, B002…
        $count = Bus::count() + 1;
        $data['bus_code'] = 'B' . str_pad($count,3,'0',STR_PAD_LEFT);

        Bus::create($data);
        return redirect()->route('admin.buses.index')
                         ->with('success','Bus added.');
    }

    public function show(Bus $bus)
    {
        // returns JSON for modal
        return response()->json($bus);
    }
    public function update(Request $request, Bus $bus)
{
    $data = $request->validate([
      'bus_name'      => 'required|string|max:255',
      'bus_plate'     => "required|string|unique:buses,bus_plate,{$bus->id}",
      'seat_capacity' => 'required|integer|min:1',
      'status'        => 'required|in:Active,Inactive',
    ]);
    $bus->update($data);
    return redirect()->route('admin.buses.index')
                     ->with('success','Bus updated.');
}
}
