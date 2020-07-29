<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/9/20
 * Time: 12:33 AM
 */

namespace App\Http\Controllers\Api\Merchant;


use App\Exceptions\Api\ForbiddenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Merchant\AuthRequest;
use App\Services\Constants\BusinessErrorCodes;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return mixed
     * @throws ForbiddenException
     */
    public function auth(AuthRequest $request)
    {
        $user = auth()->user();
    
        if (! $user->isActiveAndConfirmed()) {
        
            auth()->logout();
        
            throw new ForbiddenException(BusinessErrorCodes::AUTHORIZATION_ERROR);
        }
    
        $token = \JWTAuth::fromUser($user);
        
//        event(new UserLoggedIn($user));
    
        return $this->respondWithToken($token);
    }
}
