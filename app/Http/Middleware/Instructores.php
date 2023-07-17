<?php

namespace App\Http\Middleware;

use Closure;

class Instructores
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
            if($request->user()->idrol == 3){
                return redirect()->guest('/Home');
            }
           
        }else{
            return redirect()->guest('/');
        }
        return $next($request);
    }
}
