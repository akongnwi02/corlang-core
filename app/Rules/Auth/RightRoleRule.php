<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/19/20
 * Time: 2:07 PM
 */

namespace App\Rules\Auth;


use Illuminate\Contracts\Validation\Rule;

class RightRoleRule implements Rule
{
    
    protected $userHighestRole;
    
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
        if (auth()->user()->id == 1) {
            return true;
        }
        
        if (auth()->user()->hasRole(config('access.users.admin_role'))) {
            $this->userHighestRole = config('access.users.admin_role');
            return (! in_array(config('access.users.admin_role'), $value));
        }
        
        if (auth()->user()->hasRole(config('access.users.company_admin_role'))) {
            $this->userHighestRole = config('access.users.company_admin_role');
            return (! in_array(config('access.users.admin_role'), $value))
                && (! in_array(config('access.users.company_admin_role'), $value));
        }
        
        if (auth()->user()->hasRole(config('access.users.branch_admin_role'))) {
            $this->userHighestRole = config('access.users.branch_admin_role');
            return (! in_array(config('access.users.admin_role'), $value))
                && (! in_array(config('access.users.company_admin_role'), $value))
                && (! in_array(config('access.users.branch_admin_role'), $value));
        }
        return false;
    }
    
    
    /**
     * Get the validation error message.)
     *
     * @return string
     */
    public function message()
    {
        return __('auth.unauthorized_role', ['highest_role' => __($this->userHighestRole)]);
    }
}
