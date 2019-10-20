<?php

namespace App\Http\Middleware;

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
        if((auth()->user()->user_type==0)||(auth()->user()->user_type==1))
            return $next($request);
        else{
            notify()->flash('Sorry! The page you requested require admin priviledges!', 'warning');
            return redirect()->route('403');
        }
    }
}
