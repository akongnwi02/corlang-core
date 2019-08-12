<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Rules\Auth\ActiveCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @param $uuid
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function confirm(Request $request, $uuid)
    {
        $this->validate($request, ['code' => ['required', 'string', new ActiveCode($uuid)]]);

        $user = $this->userRepository->findByUuid($uuid);

        $this->userRepository->confirm($request['code'], $user);

        auth()->login($user);

        return redirect()->route(home_route())->withFlashSuccess(__('exceptions.frontend.auth.confirmation.success'));
    }

    /**
     * @param $uuid
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function sendConfirmationCode($uuid)
    {
        $user = $this->userRepository->findByUuid($uuid);

        if ($user->isConfirmed()) {
            return redirect()->route(home_route())->withFlashSuccess(__('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        $user->updateConfirmationCode();

        $user->save();

        $user->notify(new UserNeedsConfirmation());

        return redirect()->back()
            ->withFlashSuccess(__('exceptions.frontend.auth.confirmation.code_resent', [
                'account' => $user->getNotificationAccount(),
                'url' => route('frontend.auth.account.confirm.resend',
                    $user->{$user->getUuidName()})
            ]));
    }

    public function showConfirmationForm($uuid)
    {
        return view('frontend.auth.confirm.confirm')
            ->withUuid($uuid);
    }

}
