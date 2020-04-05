<?php

namespace App\Http\Middleware;

use App\services\utility\MyLoggerMono;
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
        $path = $request->path;
        MyLoggerMono::info("Entering my Security Service in handle() at path " . $path);
        
        $secureCheck = true;
        if($request->is('/') || $request->is('loginUser') || $request->is('registerUser') || $request->is('login') 
            || $request->is('registration') || $request->is('usersrest') || $request->is('usersrest/*') || $request->is('jobsrest') 
            || $request->is('jobsrest/*'))
        {
            $secureCheck = FALSE;
            MyLoggerMono::info($secureCheck ? "Security Middleware in handle() Needs Security" :
                "Security Middleware in handle() No Needs Security");
        }
        
        if($secureCheck && $request->session()->has('currentUser') == null)
        {
            MyLoggerMono::info("Leaveing My Security Middlewaer in handel doing a redirect back to login");
            return redirect('/login');
        }
        
        return $next($request);
    }
}
