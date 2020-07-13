<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('permission-denied');
        }
        //1 admin
        if (Auth::user()->role == 1) {
            return $next($request);
        }
        //2 clients
        if (Auth::user()->role == 2) {
            return redirect()->route('clients.show');
        }
        //3 user
        if (Auth::user()->role == 3) {
            return redirect()->route('user.index');
        }
    }
}
