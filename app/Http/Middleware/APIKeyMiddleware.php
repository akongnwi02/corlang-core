<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/18/20
 * Time: 5:14 PM
 */

namespace App\Http\Middleware;


use App\Exceptions\Api\ForbiddenException;
use App\Services\Constants\BusinessErrorCodes;
use Closure;
use Illuminate\Http\Request;

class APIKeyMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next)
    {
        $apiKey = config('access.api_key');
        
        if ($request->header('x-api-key') != $apiKey) {
            
            \Log::error('Invalid API key');
    
            if (config('access.partner_restriction')) {
        
                throw new ForbiddenException(BusinessErrorCodes::INVALID_API_KEY, 'Invalid API key');
            }
        }
        return $next($request);
    }
}
