<?php

namespace App\Rules\Auth;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Frontend\Auth\UserRepository as FrontendUserRepository;

/**
 * Class UnusedPassword.
 */
class ActiveCode implements Rule
{
    /**
     * @var
     */
    protected $uuid;

    /**
     * Create a new rule instance.
     *
     * @param $uuid
     * @return void
     */
    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws \App\Exceptions\GeneralException
     */
    public function passes($attribute, $value)
    {
        $user = resolve(FrontendUserRepository::class)->findByUuid($this->uuid);

        if (! config('access.users.confirmation_code.expiration_time')) {
            return true;
        }

        if (Carbon::now()->diffInMinutes($user->code_sent_at) >= config('access.users.confirmation_code.expiration_time')) {
            if ($user->confirmation_code == $value) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.code_expired');
    }
}
