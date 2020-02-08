<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 1:27 AM
 */

namespace App\Models\Traits\Methods;


use App\Models\Account\Account;

trait AccountMethod
{
    function generateCode() {
        $code = mt_rand(100000000, 999999999);
        if ($this->codeExists($code)) {
            $this->generateCode();
        }
        
        return $code;
    }
    
    function codeExists($code) {
        return Account::where('code', $code)->exists();
    }
}
