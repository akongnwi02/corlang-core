<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/8/19
 * Time: 4:58 PM
 */

namespace App\Http\Controllers\Api\Auth;


use App\Exceptions\Api\ConflictException;
use App\Exceptions\Api\NotFoundHttpException;
use App\Notifications\Api\Auth\UserNeedsConfirmation;
use App\Repositories\Api\Auth\UserRepository;

class ConfirmRegistrationController
{

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws ConflictException
     * @throws NotFoundHttpException
     */
    public function confirm($code)
    {
        $this->user->confirm($code);

        return response()->json(['message' => __('exceptions.api.auth.confirmation.success')]);
    }

    /**
     * @param $uuid
     *
     * @return mixed
     * @throws ConflictException
     * @throws NotFoundHttpException
     */
    public function sendConfirmationEmail($uuid)
    {
        $user = $this->user->findByUuid($uuid);

        if ($user->isConfirmed()) {
            \Log::error('Account already confirmed', ['email' => $user->email]);

            throw new ConflictException('exceptions.api.auth.confirmation.already_confirmed');
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return response()->json(['message' => __('exceptions.frontend.auth.confirmation.resent')], 200);
    }
}