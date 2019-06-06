<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/6/19
 * Time: 1:17 PM
 */

namespace App\Models\Traits;


trait Jwt
{
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}