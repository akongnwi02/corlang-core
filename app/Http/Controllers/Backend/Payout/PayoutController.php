<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/19/20
 * Time: 11:06 PM
 */

namespace App\Http\Controllers\Backend\Payout;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Payout\PayoutStatusRequest;
use App\Models\Account\Payout;
use App\Repositories\Backend\Account\PayoutRepository;

class PayoutController extends Controller
{
    /**
     * @param PayoutStatusRequest $request
     * @param Payout $payout
     * @param PayoutRepository $payoutRepository
     * @param $status
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(PayoutStatusRequest $request, Payout $payout, PayoutRepository $payoutRepository, $status)
    {
        $payoutRepository->mark($payout, $status);
    
        return redirect()->route('admin.account.payout.show', $payout->account->uuid)
            ->withFlashSuccess(__('alerts.backend.payout.status_updated'));
    }
}
