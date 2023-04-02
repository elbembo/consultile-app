<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->approved == 1) {
            Session::flush();
            Auth::logout();
            return redirect()->route('approval');
        }
        if (auth()->user()->suspend == 1) {
            Session::flush();
            Auth::logout();
            return redirect()->route('suspend');
        }
        return $next($request);
    }
}
