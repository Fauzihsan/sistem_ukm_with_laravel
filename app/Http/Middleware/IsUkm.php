<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facedas\Auth;

class IsUkm
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
            return $next($request);
        }
        else{
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai Pengurus UKM',
                'alert-type' => 'error'
        );
            return redirect('home')->with($notification);
        }
    }
}
