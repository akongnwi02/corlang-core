<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:13 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Auth\User;
use App\Models\Company\Company;
use App\Models\Merchant\MerchantOrder;
use App\Models\Service\Category;
use App\Models\Service\PaymentMethod;
use App\Models\Service\Service;

trait TransactionRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'uuid');
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'uuid');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'uuid');
    }
    
    public function merchant_order()
    {
        return $this->belongsTo(MerchantOrder::class, 'uuid', 'payment_transaction_id');
    }
}
