<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:04 PM
 */

namespace App\Models\Traits\Methods;


trait ServiceMethod
{
    public function isActive()
    {
        return $this->is_active;
    }
}
