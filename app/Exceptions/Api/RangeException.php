<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/22/20
 * Time: 10:37 PM
 */

namespace App\Exceptions\Api;


class RangeException extends \Exception
{
    public $errors;
    
    public $parameter;
    
    public $status = 416;
    
    public function __construct($message = 'Amount not in defined range')
    {
        parent::__construct($message);
    }
    
    public function status()
    {
        return $this->status;
    }
    
}
