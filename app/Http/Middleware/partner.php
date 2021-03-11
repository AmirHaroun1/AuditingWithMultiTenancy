<?php

namespace App\Http\Middleware;

use Closure;

class partner
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
        if (auth()->user()->role != 'شريك اداري')
        {
            return abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
