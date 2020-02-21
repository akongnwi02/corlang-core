<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 11:19 PM
 */

namespace App\Http\Controllers\Backend\Account;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Account\RequestPayoutRequest;
use App\Http\Requests\Backend\Account\ShowAccountRequest;
use App\Models\Account\Account;
use App\Repositories\Backend\Account\AccountRepository;
use App\Repositories\Backend\Account\PayoutRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class PayoutAccountController extends Controller
{
    public function index(AccountRepository $accountRepository, ServiceRepository $serviceRepository)
    {
        return view('backend.accounts.payout.index')
            ->withAccounts($accountRepository->getAllAccounts()->paginate())
            ->withPaymentMethods($serviceRepository->getPaymentMethods()->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    public function show(ShowAccountRequest $request, Account $account, PayoutRepository $payoutRepository)
    {
        return view('backend.accounts.payout.show')
            ->withAccount($account)
            ->withPayouts($payoutRepository->getAllPayouts($account)->paginate());
    }
    
    /**
     * @param RequestPayoutRequest $request
     * @param PayoutRepository $payoutRepository
     * @param Account $account
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function payout(RequestPayoutRequest $request ,PayoutRepository $payoutRepository, Account $account)
    {
        $payoutRepository->payout($account, $request->only(['amount', 'currency_id', 'comment', 'account_number', 'paymentmethod_id']));
    
        return redirect()->route('admin.account.payout.index')
            ->withFlashSuccess(__('alerts.backend.account.paid_out'));
    }
    
}
