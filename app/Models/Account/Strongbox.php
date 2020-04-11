<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/3/20
 * Time: 1:28 AM
 */

namespace App\Models\Account;


use App\Models\Traits\Relationships\StrongboxRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Strongbox extends Model
{
    use Uuid,
        StrongboxRelationship;
    
    protected $table = 'strongboxes';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
}
