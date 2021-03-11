<?php

namespace App\Http\Middleware;

use Closure;

class auditor
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
        if (auth()->user()->role != 'مدقق')
        {
            return abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
