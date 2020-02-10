<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 6:15 PM
 */

namespace App\Http\Controllers\Backend\Account;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Account\AccountStatusRequest;
use App\Models\Account\Account;
use App\Repositories\Backend\Account\AccountRepository;

class AccountStatusController extends Controller
{
    /**
     * @param AccountStatusRequest $request
     * @param Account $account
     * @param $status
     * @param AccountRepository $accountRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(AccountStatusRequest $request, Account $account, $status, AccountRepository $accountRepository)
    {
        $accountRepository->mark($account, $status);
        
        return redirect()->route('admin.dashboard')
            ->withFlashSuccess(__('alerts.backend.companies.company.status_updated'));
    }
}
