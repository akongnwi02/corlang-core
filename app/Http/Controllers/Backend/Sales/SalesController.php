<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/31/20
 * Time: 12:02 AM
 */

namespace App\Http\Controllers\Backend\Sales;


use App\Repositories\Api\Business\TransactionRepository;

class SalesController
{
    public function index(TransactionRepository $transactionRepository)
    {
        return view('backend.sales.index')
            ->withSales($transactionRepository->getAllSales()->paginate());
    }
}
