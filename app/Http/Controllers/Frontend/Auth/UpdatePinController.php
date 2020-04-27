<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/15/20
 * Time: 8:40 PM
 */

namespace App\Http\Controllers\Frontend\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdatePinRequest;
use App\Http\Requests\Frontend\User\CreatePinRequest;
use App\Repositories\Frontend\Auth\UserRepository;

class UpdatePinController extends Controller
{
    /**
     * @param UpdatePinRequest $request
     * @param UserRepository $userRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdatePinRequest $request, UserRepository $userRepository)
    {
        $userRepository->updatePin($request->input('pin'));
    
        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.pin_changed'));
    }
    
    /**
     * @param CreatePinRequest $request
     * @param UserRepository $userRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function create(CreatePinRequest $request, UserRepository $userRepository)
    {
        $userRepository->updatePin($request->input('pin'));
    
        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.pin_created'));
    }
}
