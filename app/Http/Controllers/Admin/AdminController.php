<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function terminals()
    {
        return view('admin.terminals');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function tickets()
    {
        return view('admin.tickets');
    }

    public function buses()
    {
        return view('admin.buses');
    }
//     public function buses()
// {
//     return view('admin.buses');
// }

}
