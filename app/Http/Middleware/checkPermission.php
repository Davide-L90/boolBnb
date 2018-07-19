<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class checkPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /*
        If the user that requested a route is not logged, will be redirect to
        login view
    */ 
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        
        return $next($request);
    }
}
