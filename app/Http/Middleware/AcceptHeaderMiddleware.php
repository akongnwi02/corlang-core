<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/5/19
 * Time: 7:25 PM
 */

namespace App\Http\Middleware;

use App\Exceptions\Api\BadRequestException;
use App\Exceptions\GeneralException;
use App\Services\Constants\BusinessErrorCodes;
use Closure;

class AcceptHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws GeneralException
     */
    public function handle($request, Closure $next)
    {

        /*
         *  check header and determin accept
         */
        $accepts = $request->header('Accept');

        $accepts = explode(',', $accepts);

        /*
         * check if the header is missed and provide it
         */
        if (empty($accepts) || $accepts[0] == '*/*')
        {

            $accepts[] = 'application/json';

            \Log::debug('request accept type has been derived automatically');
        }

        /*
         * verify the accept header
         */
        if (! in_array('application/json', $accepts)) {

            \Log::error('A required accept parameter is not present application/json');

            throw new BadRequestException(BusinessErrorCodes::INVALID_ACCEPT_HEADER_ERROR, 'Invalid accept header. Header should include application/json');
        }

        /*
         * Set the request accept header
         */
        $request->headers->set('Accept', 'application/json');

        \Log::debug('Request header accept set');

        /*
         * get the response after the request is done
         */
        $response = $next($request);

        /*
         * Set the accept type header in the response
         */
        $response->headers->set('Accept', 'application/json');

        return $response;
    }

}
