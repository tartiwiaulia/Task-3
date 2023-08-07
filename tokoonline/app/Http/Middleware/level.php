<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect; // Add this line to import the Redirect facade
use Symfony\Component\HttpFoundation\Response;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$levels
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        $userLevel = Auth::check() ? Auth::user()->level : null;

        if (in_array($userLevel, $levels)) {
            return $next($request);
        }
        if (Auth::user()->level == 'admin') {
            return Redirect::to('dashboard');
        } elseif (Auth::user()->level == 'owner') {
            return Redirect::to('dashboard');
        } elseif (Auth::user()->level == 'operator') {
            return Redirect::to('dashboard');
        } elseif (Auth::user()->level == 'pelanggan') {
            return Redirect::to('/');
        }
    }
}
