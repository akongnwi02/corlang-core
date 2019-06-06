<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class BadRequestException extends Exception
{
    use ExceptionTrait;

    protected $code = 429;

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
        return response()->json($this->getExceptionResponse(), $this->code);
    }
}
