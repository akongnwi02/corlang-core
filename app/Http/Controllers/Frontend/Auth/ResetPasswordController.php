<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Exceptions\GeneralException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Frontend\Auth\ResetPasswordRequest;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param $uuid
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\GeneralException
     * @throws \App\Exceptions\GeneralException
     */
    public function showResetForm($uuid)
    {
        return view('frontend.auth.passwords.reset')->withUuid($uuid);
    }

    /**
     * Reset the given user's password.
     *
     * @param  ResetPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\GeneralException
     */
    public function reset(ResetPasswordRequest $request, $uuid)
    {

        $user = $this->userRepository->findByUuid($uuid);

        if ($this->resetPassword($user, $request['password'])) {
            return $this->sendResetResponse('exceptions.frontend.auth.password.reset_successful');
        }

         return $this->sendResetFailedResponse($request, 'exceptions.frontend.auth.password.reset_not_confirmed');
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     * @return bool
     * @throws GeneralException
     */
    protected function resetPassword($user, $password)
    {
        if (! $user->reset_confirmed) {
            throw new GeneralException(__('exceptions.frontend.auth.password.reset_not_confirmed'));
        }

        $user->password = $password;

        $user->setRememberToken(Str::random(60));

        // Reset the reset confirmed flag

        $user->reset_confirmed = 0;

        if ($user->save()) {

            event(new PasswordReset($user));

            $this->guard()->login($user);

            return true;
        }

        return false;
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse($response)
    {
        return redirect()->route(home_route())->withFlashSuccess(trans($response));
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('username'))
            ->withErrors(['username' => trans($response)]);
    }
}
