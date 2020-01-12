<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 */
class CompanyType extends Model
{
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
        'name_en',
        'name_fr',
        'code'
    ];

}
