<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class UnauthorizedException extends Exception
{
    use ExceptionTrait;

    protected $code = 401;

    public function __construct($message, Throwable $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }

    public function render()
    {
        switch ($this->message) {
            /*
             * Unauthorized
             */
            case 'exceptions.api.auth.login.unauthorized':
                $code = '4011';
                break;

            case 'exceptions.api.auth.deactivated':
                $code = '4012';
                break;

            case 'exceptions.api.auth.login.refresh_error':
                $code = '4013';
                break;

            case 'exceptions.api.request.bad.token_expired':
                $code = '4014';
                break;
            case 'exceptions.api.request.bad.token_invalid':
                $code = '4015';
                break;

            case 'exceptions.api.request.bad.token_unknown_error':
                $code = '4016';
                break;

            default:
                $this->message = 'exceptions.api.auth.login.general_error';
                $code = '4010';

        }
        return response()->json($this->getExceptionResponse($code), $this->code);
    }
}
