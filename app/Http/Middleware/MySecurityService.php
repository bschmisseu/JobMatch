<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * MySecutiryService.php  1.0
 * April 19 2020
 *
 * Security service to intercept all request
 */

namespace App\Http\Middleware;

use App\services\utility\MyLoggerMono;
use Closure;

class MySecurityService
{
    /**
     * Method to be called when a user is making a request to determine if the user needs to be logged in or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //gets the path of the request
        $path = $request->path;
        MyLoggerMono::info("Entering my Security Service in handle() at path " . $path);
        
        //Checks to see if path is equal to a page that can be accessed with a user not loggedin
        $secureCheck = true;
        if($request->is('/') || $request->is('loginUser') || $request->is('registerUser') || $request->is('login') 
            || $request->is('registration') || $request->is('usersrest') || $request->is('usersrest/*') || $request->is('jobsrest') 
            || $request->is('jobsrest/*'))
        {
            //If path is not be be accesed by a not registered user
            $secureCheck = FALSE;
            MyLoggerMono::info($secureCheck ? "Security Middleware in handle() Needs Security" :
                "Security Middleware in handle() No Needs Security");
        }
        
        //Checks to see if there is a user logged in
        if($secureCheck && $request->session()->has('currentUser') == null)
        {
            MyLoggerMono::info("Leaveing My Security Middlewaer in handel doing a redirect back to login");
            return redirect('/login');
        }
        
        return $next($request);
    }
}
