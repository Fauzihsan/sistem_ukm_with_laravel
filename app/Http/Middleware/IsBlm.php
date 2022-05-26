<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBlm
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
        else{
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai BLM',
                'alert-type' => 'error'
        );
            return redirect('home')->with($notification);
        }
    }
}
