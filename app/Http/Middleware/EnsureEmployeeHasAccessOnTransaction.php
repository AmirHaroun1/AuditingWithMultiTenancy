<?php

namespace App\Http\Middleware;

use App\Transaction;
use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureEmployeeHasAccessOnTransaction
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
       // return $next($request);
        $CurrentAuthOfficeBranch = Auth::user()->OfficeBranch;
        if($CurrentAuthOfficeBranch->is_main && Auth::user()->role == 'مدير مراجعة'){
            return $next($request);
        }else if ($CurrentAuthOfficeBranch->id == Transaction::where('id',$request->Transaction_id)->firstOrFail()->branch_office_id){
            return $next($request);
        }else{
            return abort(401);
        }
    }
}
