<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrador 
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
            if($request->user()->idrol == 2){
                return redirect()->guest('/home-profesor');
            }
            if($request->user()->idrol == 3){
                return redirect()->guest('/Home');
            }
           
        }else{
            return redirect()->guest('/');
        }
        return $next($request);
    }
}
