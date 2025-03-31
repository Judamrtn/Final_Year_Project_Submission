<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Show the admin registration form.
     */
    public function showRegistrationForm()
    {
        return view('admin.registeradmin');
    }

    /**
     * Handle admin registration.
     */
    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Create a new admin
        Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    
        // Redirect to login page
        return redirect()->route('admin.login')->with('success', 'Registration successful! Please login.');
    }

    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.loginadmin');
    }

    /**
     * Handle admin login.
     */
 

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('department.dashboard')->with('success', 'Login successful!');
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}

    /**
     * Log out the admin.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
}