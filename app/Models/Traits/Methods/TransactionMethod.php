<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:14 PM
 */

namespace App\Models\Traits\Methods;


use App\Models\Transaction\Transaction;

trait TransactionMethod
{
    public static function generateCode() {
        $code = mt_rand(1000000000, 9999999999);
        if (static::codeExists($code)) {
            \Log::warning('Transaction code already exist. Generating a new one', ['code' => $code]);
            static::generateCode();
        }
        
        return $code;
    }
    
    public static function codeExists($code) {
        return Transaction::where('code', $code)->exists();
    }
}
