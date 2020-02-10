<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 6:15 PM
 */

namespace App\Http\Controllers\Backend\Account;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Account\FloatAccountRequest;
use App\Models\Account\Account;
use App\Repositories\Backend\Movement\MovementRepository;

class AccountController extends Controller
{
    /**
     * @param FloatAccountRequest $request
     * @param Account $account
     * @param MovementRepository $movementRepository
     * @return mixed
     * @throws \Throwable
     */
    public function float(FloatAccountRequest $request, Account $account, MovementRepository $movementRepository)
    {
        $movementRepository->floatAccount($account, $request->only(['amount', 'currency_id']));
        
        return redirect()->route('admin.dashboard')
            ->withFlashSuccess(__('alerts.backend.account.floated'));
    
    }
}
