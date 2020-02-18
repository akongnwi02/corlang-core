<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 11:19 PM
 */

namespace App\Http\Controllers\Backend\Account;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Account\AccountRepository;

class PayoutAccountController extends Controller
{
    public function index(AccountRepository $accountRepository)
    {
        return view('backend.accounts.payout.index')
            ->withAccounts($accountRepository->getAllAccounts()->paginate());
    }
}
