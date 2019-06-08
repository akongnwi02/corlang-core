<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/5/19
 * Time: 6:07 PM
 */

namespace App\Exceptions\Api;


trait ExceptionTrait
{
    /**
     * @param $code
     * @return array
     */
    public function getExceptionResponse($code){
        $exceptionResponse = [
            'code' => $code,
            'title' => $this->message,
            'message' => __($this->message),
        ];

        $previous = $this->getPrevious();

        if (! is_null($previous) && $previous instanceof \Illuminate\Validation\ValidationException) {
            $exceptionResponse['errors'] = $previous->errors();
        }
            
        if (config('app.debug')) {
            $exceptionResponse['debug'] = (string)$previous;
        }

        return $exceptionResponse;
    }
}