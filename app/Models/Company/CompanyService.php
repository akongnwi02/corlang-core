<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 10:11 PM
 */

namespace App\Models\Company;


use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    protected $table = 'company_service';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'company_id',
        'service_id',
        'is_active',
        'agentcommission_id',
        'companycommission_id',
        'custoemrcommission_id',
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];
}
