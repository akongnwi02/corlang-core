<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    use ExceptionTrait;

    protected $code = 422;

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
            case 'exceptions.api.request.validation.unprocessable_entity':
                $code = '4221';
                break;

            default:
                $code = '4220';

        }
        return response()->json($this->getExceptionResponse($code), $this->code);
    }
}
