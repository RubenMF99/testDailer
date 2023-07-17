<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Users
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
        if(auth()->check()){
            if($request->user()->idrol == 1){
                return redirect()->guest('/administradores');
            }
            if($request->user()->idrol == 2){
                return redirect()->guest('/home-profesor');
            }
            
        }else{
            return redirect()->guest('/');
        }
        return $next($request);
    }
}
