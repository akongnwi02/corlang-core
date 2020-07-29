<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class UnauthorizedException extends Exception
{
    public $error_code;
    
    public $status = 401;
    
    public function __construct($error_code, $message = "User is not authenticated")
    {
        $this->error_code = $error_code;
        
        parent::__construct($message);
    }
    
    public function status()
    {
        return $this->status;
    }
    
    public function error_code()
    {
        return $this->error_code;
    }
}
