<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/9/20
 * Time: 12:08 AM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Auth\User;
use App\Models\Company\Company;
use App\Models\Merchant\MerchantItem;
use App\Models\Service\PaymentMethod;
use App\Models\Transaction\Transaction;

trait MerchantOrderRelationship
{
    public function items()
    {
        return $this->hasMany(MerchantItem::class, 'order_id', 'uuid');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'uuid');
    }
    
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_id', 'uuid');
    }
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'payment_transaction_id', 'uuid');
    }
}
