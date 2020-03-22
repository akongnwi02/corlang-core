<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/21/20
 * Time: 10:30 PM
 */

namespace App\Services\Clients;

interface CategoryInterface
{
    public function validate($request);
    
    public function confirm();
}
