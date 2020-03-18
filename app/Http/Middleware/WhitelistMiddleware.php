<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/18/20
 * Time: 10:40 AM
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class WhitelistMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        // wrong. verify later
        $whitelist = config('app.access.whitelist');
        
        if ($request->ip() != "192.168.0.155") {
            // here instead of checking a single ip address we can do collection of ips
            //address in constant file and check with in_array function
            return redirect('home');
        }
    
        return $next($request);
    }
}
