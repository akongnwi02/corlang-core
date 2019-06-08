<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/5/19
 * Time: 7:25 PM
 */

namespace App\Http\Middleware;

use App\Exceptions\Api\BadRequestException;
use Closure;

class AcceptHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws BadRequestException
     */
    public function handle($request, Closure $next)
    {

        /*
         *  check header and determin accept
         */
        $accept = $request->header('Accept');

        /*
         * check if the header is missed and provide it
         */
        if (! $accept || $accept == '*/*') {

            $accept = 'application/json';

            \Log::debug('request accept type has been derived automatically');
        }

        /*
         * check verify the accept header
         */
        if ($accept !== 'application/json') {

            \Log::error('Invalid accept in header');

            throw new BadRequestException('exceptions.api.request.bad.invalid_accept');
        }

        /*
         * Set the request accept header
         */
        $request->headers->set('Accept', $accept);

        \Log::debug('Request header accept set');

        /*
         * get the response after the request is done
         */
        $response = $next($request);

        /*
         * Set the accept type header in the response
         */
        $response->headers->set('Accept', $accept);

        return $response;
    }

}
