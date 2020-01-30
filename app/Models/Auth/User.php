<?php

namespace App\Models\Auth;

use App\Models\Traits\Jwt;
use App\Models\Traits\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\SendUserPasswordReset;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Wildside\Userstamps\Userstamps;

/**
 * Class User.
 * @property mixed confirmation_code
 */
class User extends Authenticatable implements JWTSubject
{
    use HasRoles,
        Notifiable,
        SendUserPasswordReset,
        SoftDeletes,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        Uuid,
        Jwt,
        Userstamps;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'avatar_type',
        'avatar_location',
        'user_agent',
        'password',
        'password_changed_at',
        'active',
        'confirmation_code',
        'code_sent_at',
        'notification_channel',
        'confirmed',
        'reset_confirmed',
        'to_be_logged_out',
        'location',
        'last_login_at',
        'last_login_ip',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = [
        'last_login_at',
        'deleted_at',
        'code_sent_at',
    ];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active'           => 'boolean',
        'confirmed'        => 'boolean',
        'to_be_logged_out' => 'boolean',
        'reset_confirmed'  => 'boolean',
    ];
}
