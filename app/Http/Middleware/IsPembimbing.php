<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsPembimbing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->roles_id == 6){
            return $next($request);
        }
        else if(auth()->user()->roles_id == 1){
            return $next($request);
        }
        else{
            return redirect('home')->with('error','Anda login sebagai Pembimbing');
        }
    }
}
