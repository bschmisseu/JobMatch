<?php

namespace App\Http\Middleware;

use Closure;

class MySecurityService
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
        //$path = $request->path;
        
        $secureCheck = true;
        if($request->is('/') || $request->is('loginUser') || $request->is('registerUser') || $request->is('login') 
            || $request->is('registration'))
        {
            $secureCheck = FALSE;
        }
        
        if($secureCheck && $request->session()->has('currentUser') == null)
        {
            return redirect('/login');
        }
        
        return $next($request);
    }
}
