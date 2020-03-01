<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public $errors;
    
    public $value;
    
    public $resource;
    
    public $status = 404;
    
    public function __construct(string $resource, string $value)
    {
        $this->value = $value;
        $this->resource = $resource;
        
        $message = "$resource: $value is not found";
        
        parent::__construct($message);
    }
    
    public function errors()
    {
        return [$this->resource => [
            'not_found',
        ]];
    }
    
    public function status()
    {
        return $this->status;
    }

}
