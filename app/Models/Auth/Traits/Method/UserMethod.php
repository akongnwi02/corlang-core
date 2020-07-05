<?php

namespace App\Models\Auth\Traits\Method;

use App\Models\Transaction\Transaction;
use Carbon\Carbon;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return ! app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @return string
     */
    public function getNotificationAccount()
    {
        if ($this->notification_channel == 'sms') {
            return $this->phone;
        }
        return $this->email;
    }
    
    /**
     * @param bool $size
     *
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     * @throws \Creativeorange\Gravatar\Exceptions\InvalidEmailException
     */
    public function getPicture($size = false)
    {
        switch ($this->avatar_type) {
            case 'gravatar':
                if (! $size) {
                    $size = config('gravatar.default.size');
                }
                if (is_null($this->email)) {
                    return url('storage/avatars/default.png');
                }
                return gravatar()->get($this->email, ['size' => $size]);

            case 'storage':
                return $this->avatar_location ?: url('img/backend/avatars/default.png');
        }

        $social_avatar = $this->providers()->where('provider', $this->avatar_type)->first();
        if ($social_avatar && strlen($social_avatar->avatar)) {
            return $social_avatar->avatar;
        }

        return false;
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->hasRole(config('access.users.admin_role'));
    }
    
    /**
     * @return mixed
     */
    public function isCompanyAdmin()
    {
        return $this->hasRole(config('access.users.company_admin_role'));
    }
    
    /**
     * @return mixed
     */
    public function isBranchAdmin()
    {
        return $this->hasRole(config('access.users.branch_admin_role'));
    }
    
    /**
     * @return mixed
     */
    public function isGuest()
    {
        return $this->hasRole(config('access.users.guest_role'));
    }
    
    /**
     * @return mixed
     */
    public function isAgent()
    {
        return $this->hasRole(config('access.users.agent_role'));
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return config('access.users.requires_approval') && ! $this->confirmed;
    }

    public function isActiveAndConfirmed()
    {
        return $this->isActive() && $this->isConfirmed() && ! $this->isPending();
    }

    public function updateConfirmationCode()
    {
        $length = config('access.users.confirmation_code.length');

        $this->confirmation_code =  rand(pow(10, $length-1), pow(10, $length)-1);

        $this->code_sent_at = Carbon::now()->toDateTimeString();
    }
    
    public function canDeactivateCompanies()
    {
        return $this->can(config('permission.permissions.deactivate_companies'));
    }
    
    public function canDeactivateServices()
    {
        return $this->can(config('permission.permissions.deactivate_services'));
    }
    
    public function canCreateCompanyServices()
    {
        return $this->can(config('permission.permissions.create_company_services'));
    }
    
    public function canUpdateCompanyServices()
    {
        return $this->can(config('permission.permissions.update_company_services'));
    }
    
    public function canDeactivateCompanyServices()
    {
        return $this->can(config('permission.permissions.deactivate_company_services'));
    }
    
    public function canFreezeAccounts()
    {
        return $this->can(config('permission.permissions.freeze_accounts'));
    }
    
    public function canDeactivatePaymentMethods()
    {
        return $this->can(config('permission.permissions.deactivate_payment_methods'));
    }
    
    public function isTemporalLoggedToCompany()
    {
        return $this->is_comp_temp;
    }
    
    public function getUserCommissionBalance()
    {
        return $this->getUserCommissionTotal() - $this->account->getPayoutsTotal();
    }
    
    public function getUserCommissionTotal()
    {
        return Transaction::where('user_id', $this->uuid)
            ->where('status', config('business.transaction.status.success'))
            ->sum('agent_commission');
    }
    
    public function getTopupAccount($paymentMethod)
    {
        $topupAccounts = $this->topup_accounts;
        
        return @$topupAccounts->first(function ($topupAccount) use($paymentMethod) {
            return $topupAccount->paymentmethod_id == $paymentMethod->uuid;
        });
    }
}
