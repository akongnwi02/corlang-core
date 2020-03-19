<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/18/20
 * Time: 4:56 PM
 */

namespace App\Exceptions\Api;


class ForbiddenException extends \Exception
{
    public $errors;
    
    public $status = 403;
    
    public function __construct($message = "Request is forbidden")
    {
        parent::__construct($message);
    }
    
    public function status()
    {
        return $this->status;
    }
}
