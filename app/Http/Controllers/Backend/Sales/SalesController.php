<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/31/20
 * Time: 12:02 AM
 */

namespace App\Http\Controllers\Backend\Sales;

use App\Models\Company\Company;
use App\Models\Service\Service;
use App\Repositories\Api\Business\TransactionRepository;
use App\Repositories\Backend\Company\Company\CompanyRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class SalesController
{
    public function index(TransactionRepository $transactionRepository, ServiceRepository $serviceRepository, CompanyRepository $companyRepository)
    {
        $sales = $transactionRepository->getAllSales()->with(['service', 'company', 'user']);
        $services = auth()->user()->company->is_default ? Service::all() : auth()->user()->company->services();

        return view('backend.sales.index')
            ->withSales($sales->paginate())
            ->withStatuses(config('business.transaction.status'))
            ->withServices($services->pluck('name', 'uuid')->toArray())
            ->withCompanies(auth()->user()->company->is_default ? Company::all()->pluck('name', 'uuid')->toArray() : auth()->user()->company()->pluck('name', 'uuid')->toArray());
    }
}
