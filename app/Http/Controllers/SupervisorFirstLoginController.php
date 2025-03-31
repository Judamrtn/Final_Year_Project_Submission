<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Hash;

class SupervisorFirstLoginController extends Controller
{
    // Show the first login form
    public function showFirstLoginForm()
    {
        return view('supervisor.superregister');
    }

    // Handle the first login form submission
    public function handleFirstLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
    
        // Fetch the supervisor by SupervisorEmail
        $supervisor = Supervisor::where('SupervisorEmail', $request->email)->first();
    
        // Check if the supervisor exists
        if (!$supervisor) {
            return redirect()->back()->with('error', 'Supervisor not found.');
        }
    
        // Check if the supervisor already has a password (not first login)
        if ($supervisor->password) {
            return redirect()->back()->with('error', 'You have already set your password.');
        }
    
        // Update the password
        $supervisor->password = Hash::make($request->new_password);
        $supervisor->save();
    
        // Redirect with a success message
        return redirect()->route('supervisor.login')->with('success', 'Password set successfully. You can now log in.');
    }}