<?php

namespace App\Repositories\Frontend\Auth;

use App\Models\Account\Account;
use App\Models\Account\AccountType;
use Carbon\Carbon;
use App\Models\Auth\User;
use Illuminate\Http\UploadedFile;
use App\Models\Auth\SocialAccount;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Events\Frontend\Auth\UserConfirmed;
use App\Events\Frontend\Auth\UserResetConfirmed;
use App\Events\Frontend\Auth\UserProviderRegistered;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

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
     * @param $token
     *
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function findByPasswordResetToken($token)
    {
        foreach (DB::table(config('auth.passwords.users.table'))->get() as $row) {
            if (password_verify($token, $row->token)) {
                return $this->getByColumn($row->email, 'email');
            }
        }

        return false;
    }

    /**
     * @param $uuid
     *
     * @return mixed
     * @throws GeneralException
     */
    public function findByUuid($uuid)
    {
        $user = $this->model
            ->uuid($uuid)
            ->first();

        if ($user instanceof $this->model) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws GeneralException
     */
    public function findByConfirmationCode($code)
    {
        $user = $this->model
            ->where('confirmation_code', $code)
            ->first();

        if ($user instanceof $this->model) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data)
    {
        // Username is phone or email
        if ($this->isPhoneNumber($data['username'])) {
            $data['phone'] = $this->cleanPhoneNumber($data['username']);
            // assign cleaned phone number to username
            $data['username'] = $data['phone'];
        } else {
            $data['email'] = $data['username'];
        }

        return DB::transaction(function () use ($data) {
            $user = parent::create([
                'first_name'           => $data['first_name'],
                'last_name'            => $data['last_name'],
                'username'             => $data['username'],
                'phone'                => @$data['phone'] ?: null,
                'email'                => @$data['email'] ?: null,
                'confirmation_code'    => md5(uniqid(mt_rand(), true)),
                'notification_channel' => isset($data['phone']) ? 'sms' : 'mail',
                'active'               => 1,
                'password'             => $data['password'],
                // If users require approval or needs to confirm email
                'confirmed'            => config('access.users.requires_approval') || config('access.users.confirm_account') ? 0 : 1,
            ]);

            if ($user) {
    
    
                // create account for the user
                $account = new Account();
                $account->code = Account::generateCode();
                $account->type_id = AccountType::where('name', config('business.account.type.user'))->first()->uuid;
                $account->owner_id = $user->uuid;
                $account->save();
                
                
                /*
                 * Add the default site role to the new user
                 */
                $user->assignRole(config('access.users.guest_role'));
            }

            /*
             * If users have to confirm their email and this is not a social account,
             * and the account does not require admin approval
             * send the confirmation email
             *
             * If this is a social account they are confirmed through the social provider by default
             */
            if (config('access.users.confirm_account')) {
                // Pretty much only if account approval is off, confirm account is on, and this isn't a social account.

                $user->updateConfirmationCode();

                $user->save();

                $user->notify(new UserNeedsConfirmation());
            }

            /*
             * Return the user object
             */
            return $user;
        });
    }

    /**
     * @param       $id
     * @param array $input
     * @param bool|UploadedFile $image
     *
     * @return array|bool
     * @throws GeneralException
     */
    public function update($id, array $input, $image = false)
    {
        $user              = $this->getById($id);
        $user->first_name  = $input['first_name'];
        $user->last_name   = $input['last_name'];
        $user->avatar_type = $input['avatar_type'];

        // Upload profile image if necessary
        if ($image) {
            // delete previous image
            if (strlen(auth()->user()->avatar_location)) {
                Storage::disk('public')->delete(auth()->user()->avatar_location);
            }
            $user->avatar_location = $image->store('/avatars', 'public');
        } else {
            // No image being passed
            if ($input['avatar_type'] == 'storage') {
                // If there is no existing image
                if (!strlen(auth()->user()->avatar_location)) {
                    throw new GeneralException(__('exceptions.frontend.auth.no_picture'));
                }
            } else {
                // If there is a current image, and they are not using it anymore, get rid of it
                if (strlen(auth()->user()->avatar_location)) {
                    Storage::disk('public')->delete(auth()->user()->avatar_location);
                }

                $user->avatar_location = null;
            }
        }

        // E-mail check
        if (isset($input['email'])) {
            // cannot change email if it's default notification channel
            if ($user->notification_channel == 'mail') {
                throw new GeneralException(__('exceptions.frontend.auth.cannot_change_email'));
            }

            if ($user->email != $input['email']) {
                //cannot change email if it's already taken
                if ($this->getByColumn($input['email'], 'email')) {
                    throw new GeneralException(__('exceptions.frontend.auth.email_taken'));
                }
            }

            $user->email = $input['email'];
        }
        // Phone number check
        if (isset($input['phone'])) {
            $input['phone'] = $this->cleanPhoneNumber($input['phone']);

            // cannot change phone if it's default notification channel
            if ($user->notification_channel == 'sms') {
                throw new GeneralException(__('exceptions.frontend.auth.cannot_change_phone'));
            }

            if ($user->phone != $input['phone']) {
                //cannot change phone if it's already taken
                if ($this->getByColumn($input['phone'], 'phone')) {
                    throw new GeneralException(__('exceptions.frontend.auth.phone_taken'));
                }
            }
            $user->phone = $input['phone'];
        }

//            // Force the user to re-verify his account if config is set
//            if (config('access.users.confirm_account')) {
//                $user->confirmation_code = md5(uniqid(mt_rand(), true));
//                $user->confirmed = 0;
//                $user->notify(new UserNeedsConfirmation());
//            }
//
//            $updated = $user->save();

//            // Send the new confirmation e-mail
//
//            return [
//                'success' => $updated,
//                'email_changed' => true,
//            ];
////        }

        return $user->save();
    }

    /**
     * @param      $input
     * @param bool $expired
     *
     * @return bool
     * @throws GeneralException
     */
    public function updatePassword($input, $expired = false)
    {
        $user = $this->getById(auth()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            if ($expired) {
                $user->password_changed_at = Carbon::now()->toDateTimeString();
            }

            return $user->update(['password' => $input['password']]);
        }

        throw new GeneralException(__('exceptions.frontend.auth.password.change_mismatch'));
    }

    /**
     * @param $code
     *
     * @param $user
     * @return bool
     * @throws GeneralException
     */
    public function confirm($code, $user)
    {

        if ($user->confirmed == 1) {
            throw new GeneralException(__('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        if ($user->confirmation_code == $code) {

            $user->confirmed = 1;

            event(new UserConfirmed($user));

            return $user->save();
        }

        throw new GeneralException(__('exceptions.frontend.auth.confirmation.mismatch'));
    }

    /**
     * @param $code
     * @param $user
     * @return mixed
     * @throws GeneralException
     */
    public function confirmResetCode($code, $user)
    {
        if ($user->confirmation_code == $code) {

            event(new UserResetConfirmed($user));

            $user->reset_confirmed = 1;

            return $user->save();
        }

        throw new GeneralException(__('exceptions.frontend.auth.confirmation.code_reset_not_found'));
    }

    /**
     * @param $data
     * @param $provider
     *
     * @return mixed
     * @throws GeneralException
     */
    public function findOrCreateProvider($data, $provider)
    {
        // User email may not provided.
        $user_email = $data->email ?: "{$data->id}@{$provider}.com";

        // Check to see if there is a user with this email first.
        $user = $this->getByColumn($user_email, 'email');

        /*
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (!$user) {
            // Registration is not enabled
            if (!config('access.registration')) {
                throw new GeneralException(__('exceptions.frontend.auth.registration_disabled'));
            }

            // Get users first name and last name from their full name
            $nameParts = $this->getNameParts($data->getName());

            $user = parent::create([
                'first_name'  => $nameParts['first_name'],
                'last_name'   => $nameParts['last_name'],
                'email'       => $user_email,
                'active'      => 1,
                'confirmed'   => 1,
                'password'    => null,
                'avatar_type' => $provider,
            ]);

            event(new UserProviderRegistered($user));
        }

        // See if the user has logged in with this social account before
        if (!$user->hasProvider($provider)) {
            // Gather the provider data for saving and associate it with the user
            $user->providers()->save(new SocialAccount([
                'provider'    => $provider,
                'provider_id' => $data->id,
                'token'       => $data->token,
                'avatar'      => $data->avatar,
            ]));
        } else {
            // Update the users information, token and avatar can be updated.
            $user->providers()->update([
                'token'  => $data->token,
                'avatar' => $data->avatar,
            ]);

            $user->avatar_type = $provider;
            $user->update();
        }

        // Return the user object
        return $user;
    }

    /**
     * @param $fullName
     *
     * @return array
     */
    protected function getNameParts($fullName)
    {
        $parts  = array_values(array_filter(explode(' ', $fullName)));
        $size   = count($parts);
        $result = [];

        if (empty($parts)) {
            $result['first_name'] = null;
            $result['last_name']  = null;
        }

        if (!empty($parts) && $size == 1) {
            $result['first_name'] = $parts[0];
            $result['last_name']  = null;
        }

        if (!empty($parts) && $size >= 2) {
            $result['first_name'] = $parts[0];
            $result['last_name']  = $parts[1];
        }

        return $result;
    }

    public function isPhoneNumber($username)
    {
        return preg_match('/^(237|00237|\+237)?[6|2|3]{1}\d{8}$/', $username);
    }

    public function cleanPhoneNumber($phone)
    {
        return substr_replace($phone, '237', 0, -9);
    }

    /**
     * @param $username
     * @return mixed
     * @throws GeneralException
     */
    public function findByUsername($username)
    {
        $user = $this->model
            ->where('username', $username)
            ->first();
        if ($user instanceof $this->model) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.not_found'));
    }

}
