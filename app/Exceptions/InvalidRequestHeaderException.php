<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidRequestHeaderException extends Exception
{
    use ExceptionTrait;

    protected $code = 400;

    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, $this->code, $previous);
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
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
