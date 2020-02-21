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
use App\Http\Requests\Backend\Account\CreditAccountRequest;
use App\Http\Requests\Backend\Account\ShowAccountRequest;
use App\Models\Account\Account;
use App\Repositories\Backend\Account\AccountRepository;
use App\Repositories\Backend\Movement\MovementRepository;

class DepositAccountController extends Controller
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
    
    /**
     * @param AccountRepository $accountRepository
     * @return mixed
     */
    public function index(AccountRepository $accountRepository)
    {
        return view('backend.accounts.deposit.index')
            ->withAccounts($accountRepository->getAllAccounts()->paginate());
    }

    /**
     * @param ShowAccountRequest $request
     * @param Account $account
     * @param MovementRepository $movementRepository
     * @return mixed
     */
    public function show(ShowAccountRequest $request, Account $account, MovementRepository $movementRepository)
    {
        return view('backend.accounts.deposit.show')
            ->withAccount($account)
            ->withMovements($movementRepository->getAccountMovements($account)->paginate());
    }
    
    /**
     * @param CreditAccountRequest $request
     * @param Account $account
     * @param MovementRepository $movementRepository
     * @return mixed
     * @throws \Throwable
     */
    public function credit(CreditAccountRequest $request, Account $account, MovementRepository $movementRepository)
    {
        $movementRepository->creditAccount($account, $request->only(['amount', 'currency_id', 'direction']));
        
        return redirect()->route('admin.account.deposit.index')
            ->withFlashSuccess(__('alerts.backend.account.transferred'));
    }
}
