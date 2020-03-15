<?php

namespace App\Exceptions\Api;

use Exception;

class DuplicateException extends Exception
{
    public $errors;
    
    public $parameter;
    
    public $status = 409;
    
    public function __construct()
    {
        $message = 'This request may have been processed already.';
        parent::__construct($message);
    }
    
    public function status()
    {
        return $this->status;
    }

}
