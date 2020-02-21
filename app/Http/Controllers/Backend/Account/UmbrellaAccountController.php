<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 6:15 PM
 */

namespace App\Http\Controllers\Backend\Account;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Account\DrainAccountRequest;
use App\Http\Requests\Backend\Account\FloatAccountRequest;
use App\Http\Requests\Backend\Account\CreditAccountRequest;
use App\Http\Requests\Backend\Account\ShowAccountRequest;
use App\Models\Account\Account;
use App\Repositories\Backend\Account\AccountRepository;
use App\Repositories\Backend\Account\PayoutRepository;
use App\Repositories\Backend\Movement\MovementRepository;

class UmbrellaAccountController extends Controller
{

    public function index(AccountRepository $accountRepository)
    {
        return view('backend.accounts.umbrella.index')
            ->withAccounts($accountRepository->getUmbrellaAccounts()->paginate());
    }
    
    public function show(ShowAccountRequest $request, Account $account, PayoutRepository $payoutRepository)
    {
        return view('backend.accounts.umbrella.show')
            ->withAccount($account)
            ->withDrains($payoutRepository->getAccountDrains($account)->paginate());
    }
    
    /**
     * @param DrainAccountRequest $request
     * @param Account $account
     * @param PayoutRepository $payoutRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function drain(DrainAccountRequest $request, Account $account, PayoutRepository $payoutRepository)
    {
        $payoutRepository->drainAccount($account, $request->only(['amount', 'currency_id', 'comment']));
    
        return redirect()->route('admin.account.umbrella.index')
            ->withFlashSuccess(__('alerts.backend.account.drained'));
    }

    public function payout()
    {
    
    }
}
