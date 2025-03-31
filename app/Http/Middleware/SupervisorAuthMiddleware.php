<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupervisorAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('is_supervisor_logged_in')) {
            return redirect()->route('supervisor.login')->with('error', 'Please log in first.');
        }
        return $next($request);
    }
}

