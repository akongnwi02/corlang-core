<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 10/23/19
 * Time: 12:11 AM
 */

namespace App\Http\Middleware;


use App;
use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri());
        }
        
        return $next($request);
    }
}
