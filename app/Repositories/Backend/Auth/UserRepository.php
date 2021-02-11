<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Account\Account;
use App\Models\Account\AccountType;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Events\Backend\Auth\User\UserRestored;
use App\Events\Backend\Auth\User\UserConfirmed;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserTransferred;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Events\Backend\Auth\User\UserUnconfirmed;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Notifications\Backend\Auth\UserAccountActive;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return mixed
     */
    public function getUnconfirmedCount(): int
    {
        return $this->model
            ->where('confirmed', 0)
            ->count();
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getUsers()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::scope('active'),
            ])
            ->allowedSorts('users.active', 'users.created_at', 'users.username')
            ->defaultSort('-users.active', '-users.confirmed', '-users.created_at', 'users.username')
            ->whereNotIn('username', ['system'])
            ->with('roles');
    
        if (! auth()->user()->company->isDefault()) {
            return $users->select('users.*')
                ->where('users.company_id', auth()->user()->company->uuid)
                ->join('companies', 'users.company_id', '=', 'companies.uuid');
        }
    
        return $users;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = parent::create([
                'first_name'           => $data['first_name'],
                'last_name'            => $data['last_name'],
                'username'             => $data['username'],
                'phone'                => $data['phone'],
                'email'                => $data['email'],
                'password'             => $data['password'],
                'active'               => isset($data['active']) && $data['active'] == '1' ? 1 : 0,
                'confirmation_code'    => md5(uniqid(mt_rand(), true)),
                'notification_channel' => $data['notification_channel'],
                'confirmed'            => isset($data['confirmed']) && $data['confirmed'] == '1' ? 1 : 0,
                'company_id'           => $data['company_id'],
            ]);
            // See if adding any additional permissions
            if (!isset($data['permissions']) || !count($data['permissions'])) {
                $data['permissions'] = [];
            }

            if ($user) {
                // User must have at least one role
                if (!count($data['roles'])) {
                    throw new GeneralException(__('exceptions.backend.access.users.role_needed_create'));
                }
    
                // Only central users can create guest users
                if (!auth()->user()->company->is_default && !$data['company_id']) {
                    throw new GeneralException(__('exceptions.backend.access.users.no_company'));
                }
    
                // Guest user must not belong to a company
                if (in_array(config('access.users.guest_role'), $data['roles']) && $data['company_id']) {
                    throw new GeneralException(__('exceptions.backend.access.users.guest_in_company'));
                }
                
                
                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);
    
    
                // create account for the user
                $account = new Account();
                $account->code = Account::generateCode();
                $account->type_id = AccountType::where('name', config('business.account.type.user'))->first()->uuid;
                $account->owner_id = $user->uuid;
    
                if ($account->save()) {
                    
                    //Send confirmation email if requested and account approval is off
                    if (isset($data['confirmation_message']) && $user->confirmed == 0 && !config('access.users.requires_approval')) {
                        $user->notify(new UserNeedsConfirmation());
                    }
                    
                    event(new UserCreated($user));

                    return $user;
                }
            }

            throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @return User
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(User $user, array $data): User
    {
        $this->checkUniqueAttributes($user, $data);

        // See if adding any additional permissions
        if (!isset($data['permissions']) || !count($data['permissions'])) {
            $data['permissions'] = [];
        }

        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'first_name'           => $data['first_name'],
                'last_name'            => $data['last_name'],
                'username'             => $data['username'],
                'phone'                => $data['phone'],
                'email'                => $data['email'],
                'notification_channel' => $data['notification_channel'],
            ])) {
                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);

                event(new UserUpdated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * @param User $user
     * @param      $input
     *
     * @return User
     * @throws GeneralException
     */
    public function updatePassword(User $user, $input): User
    {
        if ($user->update(['password' => $input['password']])) {
            event(new UserPasswordChanged($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param User $user
     * @param      $status
     *
     * @return User
     * @throws GeneralException
     */
    public function mark(User $user, $status): User
    {
        if (auth()->id() == $user->id && $status == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->active = $status;
        $user->to_be_logged_out = true;

        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
                break;

            case 1:
                event(new UserReactivated($user));
                break;
        }

        if ($user->save()) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function confirm(User $user): User
    {
        if ($user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->confirmed = 1;
        $user->to_be_logged_out = false;
        $confirmed       = $user->save();

        if ($confirmed) {
            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('access.users.requires_approval')) {
                $user->notify(new UserAccountActive);
            }

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_confirm'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function unconfirm(User $user): User
    {
        if (!$user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.not_confirmed'));
        }

        if ($user->id == 1) {
            // Cant un-confirm admin
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_admin'));
        }

        if ($user->id == auth()->id()) {
            // Cant un-confirm self
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_self'));
        }

        $user->confirmed = 0;
        $user->to_be_logged_out = true;
        $unconfirmed     = $user->save();

        if ($unconfirmed) {
            event(new UserUnconfirmed($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(User $user): User
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($user) {
            // Delete associated relationships
            $user->passwordHistories()->delete();
            $user->providers()->delete();
            $user->sessions()->delete();

            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(User $user): User
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param User $user
     * @param      $email
     *
     * @throws GeneralException
     */
    protected function checkUniqueAttributes(User $user, $data)
    {
        //Figure out if unique attributes are not the same
        if ($user->username != $data['username']) {
            //Check to see if username exists
            if ($this->model->where('username', '=', $data['username'])->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.username_error'));
            }
        }

        if ($user->email != $data['email']) {
            //Check to see if email exists
            if ($this->model->where('email', '=', $data['email'])->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }

        }

        if ($user->phone != $data['phone']) {
            $phone = substr_replace($data['phone'], '237', 0, -9);
            //Check to see if phone number exists
            if ($this->model->where('phone', '=', $phone)->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.phone_error'));
            }
        }
    }
    
    /**
     * @param User $user
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function transfer(User $user, $data)
    {
        return DB::transaction(function () use ($user, $data) {
            if ($user->update([
                'company_id'           => $data['company_id'],
            ])) {
                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
    
                // Guest user must not belong to a company
                if (in_array(config('access.users.guest_role'), $data['roles']) && $data['company_id']) {
                    throw new GeneralException(__('exceptions.backend.access.users.guest_in_company'));
                }
            
                event(new UserTransferred($user));
            
                return $user;
            }
        
            throw new GeneralException(__('exceptions.backend.access.users.transfer_error'));
        });
    }
    
    /**
     * @param User $user
     * @return mixed
     * @throws \Throwable
     */
    public function resetPin(User $user)
    {
        return DB::transaction(function () use ($user) {
            $user->pincode = null;
            if ($user->save()) {
                return $user;
            }
            
            throw new GeneralException(__('exceptions.backend.access.users.reset_pin_error'));
        });

    }
    
    /**
     * @param User $user
     * @return mixed
     * @throws \Throwable
     */
    public function resetTopupAccount(User $user)
    {
        return DB::transaction(function () use ($user) {
            if ($user->topup_accounts()->update([
                'is_confirmed' => false,
            ])) {
                return $user;
            }
            throw new GeneralException(__('exceptions.backend.access.users.reset_topup_account_error'));
        });

    }
}
