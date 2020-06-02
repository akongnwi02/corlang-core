<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/2/20
 * Time: 1:13 AM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Auth\User;

trait BillerPaymentRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}
