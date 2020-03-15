<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/4/19
 * Time: 10:31 PM
 */

namespace App\Http\Controllers\Api\Auth;


use App\Events\Api\Auth\UserLoggedIn;
use App\Events\Api\Auth\UserLoggedOut;
use App\Exceptions\Api\UnauthorizedException;
use App\Helpers\Auth\Auth;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\Auth\User;
use App\Repositories\Api\Auth\UserRepository;
use Illuminate\Http\Request;

class LoginController
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws UnauthorizedException
     * @throws \App\Exceptions\Api\NotFoundException
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {

            throw new UnauthorizedException('exceptions.api.auth.login.unauthorized');
        }

         // At this stage, user exists. Check if user is confirmed
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (! $user->isActiveAndConfirmed()) {

            auth('api')->logout();

            throw new UnauthorizedException('exceptions.api.auth.login.require_confirmation_or_approval');
        }

        event(new UserLoggedIn($user));

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {

            app('session')->forget(config('access.socialite_session_name'));

        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Laravel specific logic
         */
        auth()->logout();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        return response()->json(['message' => __('alerts.api.users.logged_out')]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws UnauthorizedException
     */
    public function refresh()
    {
        $token = auth()->refresh();

        if (!$token) {
            throw new UnauthorizedException('exceptions.api.auth.login.refresh_error');
        }

        \Log::info('Token refreshed');

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return mixed
     */
    public function me()
    {
        return User::where('id', auth()->id())->with(['company'])->first();
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
