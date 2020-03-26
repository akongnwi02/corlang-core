<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class UnauthorizedException extends Exception
{
    public $error_code;
    
    public $status = 401;
    
    public function __construct($message = "User is not authenticated")
    {
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
