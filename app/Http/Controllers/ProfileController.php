<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show the profile form
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Handle the form submission
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'username'       => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'          => 'required|email|max:255|unique:users,email,'    . $user->id,
            'contact_number' => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
        ]);

        $user->update($data);

        return redirect()->route('profile')
                         ->with('success', 'Profile updated successfully.');
    }
}
