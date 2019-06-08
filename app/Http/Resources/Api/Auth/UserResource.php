<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed email
 * @property mixed avatar_type
 * @property mixed avatar_location
 * @property mixed active
 * @property mixed confirmed
 * @property mixed last_login_at
 * @property mixed last_login_ip
 * @property mixed timezone
 * @property mixed updated_at
 * @property mixed deleted_at
 * @property mixed created_at
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'avatar_type' => $this->avatar_type,
            'avatar_location' => $this->avatar_location,
            'active' => $this->active,
            'confirmed' => $this->confirmed,
            'timezone' => $this->timezone,
            'last_login_at' => $this->last_login_at,
            'last_login_ip' => $this->last_login_ip,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
        ];
    }
}
