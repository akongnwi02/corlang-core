<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 11:19 PM
 */

namespace App\Http\Controllers\Backend\Account;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Account\ShowAccountRequest;
use App\Models\Account\Account;
use App\Repositories\Backend\Account\AccountRepository;
use App\Repositories\Backend\Account\PayoutRepository;

class PayoutAccountController extends Controller
{
    public function index(AccountRepository $accountRepository)
    {
        return view('backend.accounts.payout.index')
            ->withAccounts($accountRepository->getAllAccounts()->paginate());
    }
    
    public function show(ShowAccountRequest $request, Account $account, PayoutRepository $payoutRepository)
    {
        return view('backend.accounts.payout.show')
            ->withAccount($account)
            ->withPayouts($payoutRepository->getAllPayouts($account)->paginate());
    }
}
