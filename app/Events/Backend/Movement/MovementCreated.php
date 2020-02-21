<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 11:18 PM
 */

namespace App\Events\Backend\Movement;


use Illuminate\Queue\SerializesModels;

class MovementCreated
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $movement;
    
    /**
     * @param $movement
     */
    public function __construct($movement)
    {
        $this->movement = $movement;
    }
}
