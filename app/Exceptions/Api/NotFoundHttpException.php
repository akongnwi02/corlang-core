<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class NotFoundHttpException extends Exception
{
    use ExceptionTrait;

    protected $code = 404;

    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * Render the exception
     */
    public function render()
    {
        switch ($this->message) {
            /*
             * Route not found
             */
            case 'exceptions.api.request.bad.route_not_found':
                $code = '4041';
                break;

            /*
             * Confirmation code not found
             */
            case 'exceptions.api.auth.confirmation.not_found':
                $code = '4042';
                break;

            /*
             * User not found
             */
            case 'exceptions.backend.access.users.not_found':
                $code = '4043';
                break;

            case 'exceptions.api.auth.login.not_found':
                $code = '4044';
                break;

            default:
                $code = '4040';
        }

        return response()->json($this->getExceptionResponse($code), $this->code);
    }
}
