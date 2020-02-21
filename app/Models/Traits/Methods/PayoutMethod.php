<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 5:20 PM
 */

namespace App\Models\Traits\Methods;


use App\Models\Account\Payout;

trait PayoutMethod
{
    public static function generateCode() {
        $code = mt_rand(1000000000, 9999999999);
        if (static::codeExists($code)) {
            static::generateCode();
        }
        
        return $code;
    }
    
    public static function codeExists($code) {
        return Payout::where('code', $code)->exists();
    }
}
