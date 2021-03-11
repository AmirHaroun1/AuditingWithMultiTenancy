<?php

namespace App\Http\Middleware;

use Closure;

class RevisingManager
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
        if (auth()->user()->role != 'مدير مراجعة')
        {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
