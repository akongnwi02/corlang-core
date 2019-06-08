<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class BadRequestException extends Exception
{
    use ExceptionTrait;

    protected $code = 400;

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
             * Unsupported local Content-Language
             */
            case 'exceptions.api.request.header.locale_unsupported':
                $code = '4001';
                break;

            /*
             * Invalid accept header in api request
             */
            case 'exceptions.api.request.header.invalid_accept':
                $code = '4002';
                break;

            /*
             * Invalid accept header in api request
             */
            case 'exceptions.api.request.bad.method_not_allowed':
                $code = '4003';
                break;

            /*
             * Too much attempts
             */
            case 'exceptions.api.request.bad.too_much_attempts':
                $code = '4004';
                break;

            /*
             * Default Exception
             */
            default:
                $code = '4000';
                break;
        }

        return response()->json($this->getExceptionResponse($code), $this->code);
    }
}
