<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->type == 'Pro'){
            return $next($request);
        }
        else if(auth()->user()->type == 'Admin'){
            return redirect()->route('admin.home');
        }
        else if(auth()->user()->type == 'User'){
            return redirect()->route('user.home');
        }
    }
}
