<?php

namespace App\Exceptions\Api;

use Exception;

class BadRequestException extends Exception
{
    public $errors;
    
    public $parameter;
    
    public $status = 400;
    
    public function __construct(string $parameter, string $value = null)
    {
        $this->parameter = $parameter;
        
        $message = "$parameter has an invalid value $value";
        
        parent::__construct($message);
    }
    
    public function errors()
    {
        return [$this->parameter => [
            'invalid',
        ]];
    }
    
    public function status()
    {
        return $this->status;
    }

}
