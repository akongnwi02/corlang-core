<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/11/20
 * Time: 12:48 AM
 */

namespace App\Models\Traits\Methods;


use App\Models\Merchant\MerchantOrder;

trait MerchantOrderMethod
{
    public static function generateCode() {
        $code = mt_rand(1000000000, 9999999999);
        if (static::codeExists($code)) {
            \Log::warning('Merchant order code already exist. Generating a new one', ['code' => $code]);
            static::generateCode();
        }
        
        return $code;
    }
    
    public static function codeExists($code) {
        return MerchantOrder::where('code', $code)->exists();
    }
}
