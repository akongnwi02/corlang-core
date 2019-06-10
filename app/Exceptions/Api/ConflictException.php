<?php

namespace App\Exceptions\Api;

use Exception;

class ConflictException extends Exception
{
    use ExceptionTrait;

    protected $code = 409;

    public function __construct(string $message, \Throwable $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }

    public function render() {
        switch ($this->message) {
            /*
             * Account already confirmed
             */
            case 'exceptions.api.auth.confirmation.already_confirmed':
                $code = '4091';
                break;

            /*
             * Confirmation mismatch
             */
            case 'exceptions.api.auth.confirmation.mismatch':
                $code = '4092';
                break;

            /*
             * Account not confirmed
             */
            case 'exceptions.api.auth.confirmation.resend':
                $code = '4093';
                break;

            default:
                $code = '4090';
                break;
        }

        return response()->json($this->getExceptionResponse($code), $this->code);
    }
}
