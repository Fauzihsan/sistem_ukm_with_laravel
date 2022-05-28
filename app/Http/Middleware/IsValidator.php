<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsValidator
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
        if(auth()->user()->roles_id == 8){
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai Validator',
                'alert-type' => 'error'
            );
            return redirect('home')->with($notification);
        }

        elseif(auth()->user()->roles_id == 1){
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai Validator',
                'alert-type' => 'error'
            );
            return redirect('home')->with($notification);
        }
        elseif(auth()->user()->roles_id == 2){
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai Validator',
                'alert-type' => 'error'
            );
            return redirect('home')->with($notification);
        }
        else{
            return $next($request);
        }
    }
}
