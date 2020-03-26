<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/25/20
 * Time: 8:29 PM
 */

namespace App\Exceptions\Api;


class ServerErrorException extends \Exception
{
    public $error_code;
    
    public $status = 500;
    
    public function __construct($error_code, $message = 'Server Error')
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
