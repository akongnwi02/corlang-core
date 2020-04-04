<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/30/20
 * Time: 11:45 PM
 */

namespace App\Http\Controllers\Backend\Provision;

use App\Repositories\Api\Business\TransactionRepository;

class PaymentMethodProvisionController
{
    public function index(TransactionRepository $transactionRepository)
    {
        return view('backend.provisions.method.index')
            ->withProvisions();
    }
}
