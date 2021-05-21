<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SecretaryAndAgent
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
        if (auth()->user()->role == 'سكرتير' || auth()->user()->role == 'مندوب شركة')
        {
            return $next($request);
        }
        return abort(403, 'Unauthorized action.');
    }
}
