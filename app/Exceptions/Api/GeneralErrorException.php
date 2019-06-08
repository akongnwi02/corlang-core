<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class GeneralErrorException extends Exception
{
    use ExceptionTrait;

    protected $code = 500;

    public function __construct($message = 'exceptions.api.request.general_error.message', Throwable $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }

    public function render()
    {
        return response()->json($this->getExceptionResponse('5000'), $this->code);
    }
}
