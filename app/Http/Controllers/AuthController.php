<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'StudentEmail' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $credentials['StudentEmail'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['StudentEmail' => 'Invalid credentials'])->withInput();
    }

    // Show dashboard (only accessible when logged in)
    public function dashboard()
    {
        return view('dashboard'); // Create 'dashboard.blade.php'
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}

