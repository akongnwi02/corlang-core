<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/9/20
 * Time: 11:56 PM
 */

namespace App\Http\Middleware;


use App\Exceptions\Api\ForbiddenException;
use App\Services\Constants\BusinessErrorCodes;
use Closure;

class ActiveAndConfirmedMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
    
        if ($user) {
            if (! $user->isActiveAndConfirmed()) {
        
                auth()->logout();
        
                throw new ForbiddenException(BusinessErrorCodes::AUTHORIZATION_ERROR);
            }
        }
        return $next($request);
    }
}
