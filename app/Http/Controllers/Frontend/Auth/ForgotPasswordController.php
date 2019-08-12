<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Rules\Auth\ActiveCode;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @param $uuid
     * @return \Illuminate\Http\Response
     */
    public function showPasswordResetRequestForm()
    {
        return view('frontend.auth.passwords.request');
    }

    /**
     * @param $uuid
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function sendPasswordResetCode($uuid)
    {
        $user = $this->userRepository->findByUuid($uuid);

        $user->updateConfirmationCode();

        $user->save();

        $user->notify(new UserNeedsPasswordReset());

        return redirect()->route('frontend.auth.password.reset.code.form', [$uuid])
            ->withFlashSuccess(__('exceptions.frontend.auth.confirmation.code_reset_resent', [
                'account' => $user->getNotificationAccount(),
                'url' => route('frontend.auth.password.reset.code.send',
                    $user->{$user->getUuidName()})
            ]));
    }

    /**
     * Send a reset code to the given user.
     *
     * @param Request $request
     * @param $uuid
     * @return
     * @throws \App\Exceptions\GeneralException
     */
    public function confirmPasswordResetCode(Request $request, $uuid)
    {
        $this->validate($request, ['code' => ['string', 'required', new ActiveCode($uuid)]]);

        $user = $this->userRepository->findByUuid($uuid);

        $this->userRepository->confirmResetCode($request['code'], $user);

        return redirect()->route('frontend.auth.password.reset.form', [$user->{$user->getUuidName()}])
            ->withFlashSuccess(__('exceptions.frontend.auth.password.reset_code_confirmed'));
    }

    public function showPasswordRestCodeForm($uuid)
    {
        return view('frontend.auth.passwords.code')->withUuid($uuid);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\GeneralException
     */
    public function initiatePasswordReset(Request $request)
    {
        $this->validate($request, ['username' => 'string|required']);

        if ($this->userRepository->isPhoneNumber($request['username'])) {
            $request['username'] = $this->userRepository->cleanPhoneNumber($request['username']);
        }

        $user = $this->userRepository->findByUsername($request['username']);

        return redirect()->route('frontend.auth.password.reset.code.send', [$user->{$user->getUuidName()}]);
    }

}
