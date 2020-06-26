<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:32 PM
 */

namespace App\Models\Company;


use App\Models\Traits\Attributes\CompanyPaymentMethodAttribute;
use App\Models\Traits\Relationships\CompanyPaymentMethodRelationship;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyPaymentMethod extends Pivot
{
    use CompanyPaymentMethodAttribute,
        CompanyPaymentMethodRelationship;
    
    protected $table = 'company_paymentmethod';
    
    public $incrementing = false;
    
    protected $fillable = [
        'company_id',
        'paymentmethod_id',
        'is_active',
        'providercommission_id',
        'customercommission_id',
    ];
}
