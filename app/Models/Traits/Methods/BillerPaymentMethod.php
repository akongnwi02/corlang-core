<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/2/20
 * Time: 1:20 AM
 */

namespace App\Models\Traits\Methods;


use App\Models\Account\BillerPayment;

trait BillerPaymentMethod
{
    public static function generateCode() {
        $code = mt_rand(100000000, 999999999);
        if (static::codeExists($code)) {
            static::generateCode();
        }
        
        return $code;
    }
    
    public static function codeExists($code) {
        return BillerPayment::where('code', $code)->exists();
    }
}
