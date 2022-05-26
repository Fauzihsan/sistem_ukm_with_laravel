<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facedas\Auth;

class IsSuperAdmin
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
        if(auth()->user()->roles_id == 1){
            return $next($request);
        } else{
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai Super Admin',
                'alert-type' => 'error'
        );
            return redirect('home')->with($notification);
        }
    }
}
