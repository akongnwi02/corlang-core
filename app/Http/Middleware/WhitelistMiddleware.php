<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/18/20
 * Time: 10:40 AM
 */

namespace App\Http\Middleware;

use App\Exceptions\Api\ForbiddenException;
use App\Services\Constants\BusinessErrorCodes;
use Closure;
use Illuminate\Http\Request;

class WhitelistMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        
        $whitelist = config('access.whitelist');
    
        $ipAddresses = explode(';', $whitelist);
        
        if (! in_array($request->ip(), $ipAddresses)) {
    
            \Log::error('IP address is not whitelisted', ['ip address', $request->ip()]);
    
            if (config('access.partner_restriction')) {
                throw new ForbiddenException(BusinessErrorCodes::IP_WHITELIST_ERROR);
            }
        }
        return $next($request);
    }
}
