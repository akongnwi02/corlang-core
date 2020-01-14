<?php

namespace App\Models\Company;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 */
class CompanyType extends Model
{
    use Uuid;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companytypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code'
    ];

}
