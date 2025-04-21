<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Pass;


class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     return view('admin.dashboard');
    // }

    public function terminals()
    {
        return view('admin.terminals');
    }

    public function schedules()
    {
        return view('admin.schedules');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function tickets()
    {
        $passes = \App\Models\Pass::with('user','schedule.origin','schedule.destination')->get();
        return view('admin.tickets', compact('passes'));
    }
    
    public function buses()
    {
        return view('admin.buses');

    }
    public function dashboard()
{
    $terminalsCount    = Terminal::count();
    $schedulesCount    = Schedule::count();
    $busesCount        = Bus::count();
    $passesCount       = Pass::count(); 

    return view('admin.dashboard', compact(
        'terminalsCount',
        'schedulesCount',
        'busesCount',
        'passesCount'
    ));
}
//     public function buses()
// {
//     return view('admin.buses');
// }

}
