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
        if(auth()->user()->roles_id == 5){
            return $next($request);
        }
        else{
            $notification = array(
                'message' => 'Anda tidak memiliki akses sebagai Pembimbing',
                'alert-type' => 'error'
        );
            return redirect('home')->with($notification);
        }
    }
}
