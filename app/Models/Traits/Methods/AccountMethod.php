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
    public static function generateCode() {
        $code = mt_rand(100000000, 999999999);
        if (static::codeExists($code)) {
            static::generateCode();
        }
        
        return $code;
    }
    
    public static function codeExists($code) {
        return Account::where('code', $code)->exists();
    }
    
    public function isActive()
    {
        return $this->is_active;
    }
    
    public function isCompanyAccount()
    {
    
    }
    
}
