<?php

namespace App\Http\Middleware;

use App\Exceptions\Api\BadRequestException;
use Closure;

class LocalizationMiddleWare
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
         * check if local is allowed to be changed
         */
        if (config('locale.status')) {

            \Log::debug('Setting locale');

            /*
             *  check header request and determine locale
             */
            $locale = $request->header('Content-Language');

            /*
             * check if the header is missed
             */
            if (! $locale) {
                /*
                 * take the default locale
                 */
                $locale = app()->getLocale();

                \Log::debug('Local has been injected automatically');
            }

            /*
             * check the language defined is supported
             */
            if (!array_key_exists($locale, config('locale.languages'))) {

                throw new BadRequestException('exceptions.api.request.bad.locale_unsupported');
            }

            /*
             * Set the application locale
             */
            app()->setLocale($locale);

            \Log::debug('Locale set', ['locale' => app()->getLocale()]);

            /*
             * get the response after the request is done
             */
            $response = $next($request);

            /*
             * Set the content language header in the response
             */
            $response->headers->set('Content-Language', $locale);

            return $response;
        }

        return $next($request);
    }
}
