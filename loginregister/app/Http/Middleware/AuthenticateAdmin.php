<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard ='admin')
    {
        // dd($guard);
        if(Auth::guard($guard)->guest()){
            return redirect(route('login'));
        }
        return $next($request);
    }
}
