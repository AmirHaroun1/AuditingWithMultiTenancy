<?php

namespace App\Http\Middleware;

use App\Tenant;
use Carbon\Carbon;
use Closure;

class CheckTenantsBeforeAccessing
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
        $subscription_end_date = Carbon::createFromFormat('Y-m-d H:i:s', Tenant('subscription_end_date'));
        if($subscription_end_date->gt(Carbon::now())){
            return $next($request);
        }else{
            return $next($request);
            $subscriber = Tenant::where('id','LIKE',\tenant('id'))->firstOrFail();
            $subscriber->status = 'expired';
            $subscriber->save();
            return view('FrontPreview.Subscription.renewal',compact('subscriber'));
        }
    }
}
