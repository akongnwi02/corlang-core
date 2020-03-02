<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/6/19
 * Time: 11:43 PM
 */

namespace App\Http\Controllers\Api\Auth;


use App\Events\Api\Auth\UserRegistered;
use App\Exceptions\Api\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Api\Auth\UserRepository;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function register(RegisterRequest $request)
    {
        if(! config('access.api_registration')) {

            throw new NotFoundException('route', request()->getRequestUri());
        }
        $user = $this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'phone',
            'email',
            'password'
        ));

        event(new UserRegistered($user));

        return $user;
    }
}
