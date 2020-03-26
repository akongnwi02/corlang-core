<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    
    public $error_code;
    
    public $resource;
    
    public $status = 404;
    
    public function __construct($error_code, $message = 'Resource or service not found')
    {
        $this->error_code = $error_code;
        
        parent::__construct($message);
    }
    
    public function error_code()
    {
        return $this->error_code;
    }
    
    public function status()
    {
        return $this->status;
    }

}
