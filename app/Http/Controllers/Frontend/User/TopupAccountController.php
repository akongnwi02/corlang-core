<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/1/20
 * Time: 11:36 PM
 */

namespace App\Http\Controllers\Frontend\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\SetupTopAccountRequest;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;

class TopupAccountController extends Controller
{
    public function setup(SetupTopAccountRequest $request, PaymentMethodRepository $paymentMethodRepository)
    {
        $topupConfig = $request->input('topup_config');
    
        $paymentMethodRepository->setTopupMethods(auth()->user(), $topupConfig);
    
        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(__('strings.frontend.user.topup_updated'));
    }
    
    public function forceTopup()
    {
        return view('frontend.user.force-topup');
    }
}
