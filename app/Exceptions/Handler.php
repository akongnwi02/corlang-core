<?php

namespace App\Exceptions;

use Exception;
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
     */
    public function render($request, Exception $exception)
    {

        if($request->expectsJson()) {
            
            $rendered = parent::render($request, $exception);

            $error['code']    = $rendered->getStatusCode();
            $error['message'] = 'Unexpected Error';
            
            if ($exception instanceof \App\Exceptions\Api\BadRequestException) {
                $error['message'] = $exception->getMessage();
                $error['errors']  = $exception->errors();
                $error['code']    = $exception->getCode();
            }
            
            if ($exception instanceof \App\Exceptions\Api\NotFoundException) {
                $error['message'] = $exception->getMessage();
                $error['errors']  = $exception->errors();
                $error['code']    = $exception->status();
            }
            
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $error['message'] = $exception->getMessage();
                $error['errors']  = $exception->errors();
            }
            
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                $error['message'] = $exception->getMessage();
            }
            
            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                $error['message'] = $exception->getMessage();
            }
            
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                $error['message'] = 'Method Not Allowed';
            }
            
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                $error['message'] = 'Route Not Found';
            }
            
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
                $error['message'] = 'Unauthorized';
            }
    
            if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
                $error['message'] = 'Too Many Attempts';
            }
    
            \Log::error('ExceptionHandler', array_merge($error, [
                'exception' => (string)$exception,
                'trace'     => $exception->getTrace(),
                'previous'  => $exception->getPrevious()
            ]));
            
            if (config('app.debug')) {
                $error['debug'] = config('app.debug') ? (string)$exception : null;
            }
            return response()->json($error, $error['code']);
        }

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return redirect()
                ->route(home_route())
                ->withFlashDanger(__('auth.general_error'));
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
