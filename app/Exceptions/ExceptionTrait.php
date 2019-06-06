<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/5/19
 * Time: 6:07 PM
 */

namespace App\Exceptions;


trait ExceptionTrait
{
    /**
     * @return array
     */
    public function getExceptionResponse(){

        switch ($this->getMessage()) {

            case 'exceptions.api.request.header.locale_unsupported':
                $code = '4001';
                break;

            case 'exceptions.api.request.header.invalid_accept':
                $code = '4002';
                break;

            default:
                $code = '5000';
                break;
        }

        $exceptionResponse = [
            'code' => $code,
            'title' => $this->getMessage(),
            'message' => __($this->getMessage()),
        ];

        if (config('app.debug')) {
            $exceptionResponse['debug'] = (string)$this->getPrevious();
        }

        return $exceptionResponse;
    }
}