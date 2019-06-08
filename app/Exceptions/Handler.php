<?php

namespace App\Exceptions;

use App\Exceptions\Api\GeneralErrorException;
use App\Exceptions\Api\ValidationException;
use Exception;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler.
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     * @throws BadRequestException
     * @throws NotFoundHttpException
     * @throws ValidationException
     * @throws GeneralErrorException
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return redirect()
                ->route(home_route())
                ->withFlashDanger(__('auth.general_error'));
        }

        /**
         *
         *
         * API exceptions handling
         *
         *
         */
        if($request->expectsJson()) {
            /**
             * All exceptions are returned in a standard format
             *
             * Uncaught exceptions throw the general exception
             * To catch a particular exception, add the exception to this list
             *
             * Exception name can be seen in debug property of error response
             */
            if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
                \Log::error('Too many requests', ['ip' => $request->getClientIp(), 'route' => $request->getRequestUri()]);
                throw new BadRequestException('exceptions.api.request.bad.too_much_attempts', $exception);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                \Log::error('Route Not found', ['ip' => $request->getClientIp(), 'route' => $request->getRequestUri()]);
                throw new NotFoundHttpException('exceptions.api.request.bad.route_not_found', $exception);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                \Log::error('Method not allowed', ['method' => $request->method(), 'route' => $request->getRequestUri()]);
                throw new BadRequestException('exceptions.api.request.bad.method_not_allowed');

            }

            if($exception instanceof \Illuminate\Validation\ValidationException) {
                \Log::error('Validation', ['debug' => (string)$exception, 'method' => $request->method(), 'route' => $request->getRequestUri()]);
                throw new ValidationException('exceptions.api.request.validation.unprocessable_entity', $exception);
            }

            /**
             * Catch all uncaught exceptions and report through general error exception class
             */
            if (method_exists($exception, 'render') && $response = $exception->render($request)) {
                return \Illuminate\Routing\Router::toResponse($request, $response);
            } elseif ($exception instanceof \Illuminate\Contracts\Support\Responsable) {
                return $exception->toResponse($request);
            }
            $exception = $this->prepareException($exception);
            \Log::error('Undocumented exception occured', ['debug' => (string)$exception]);
            throw new GeneralErrorException('exceptions.api.request.general_error.message', $exception);
        }

        /**
         *
         * General purpose exception handling for both WEB and API
         *
         */
        return parent::render($request, $exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => 'Unauthenticated.'], 401)
            : redirect()->guest(route('frontend.auth.login'));
    }

}
