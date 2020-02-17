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

class UmbrellaAccountController extends Controller
{

    public function index(AccountRepository $accountRepository)
    {
        return view('backend.accounts.umbrella.index')
            ->withAccounts($accountRepository->getAllAccounts()->paginate());
    }

    public function payout()
    {
    
    }
}
