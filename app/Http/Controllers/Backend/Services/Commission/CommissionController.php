<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/24/20
 * Time: 6:42 PM
 */

namespace App\Http\Controllers\Backend\Services\Commission;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Commission\StoreCommissionRequest;
use App\Http\Requests\Backend\Services\Commission\UpdateCommissionRequest;
use App\Models\Business\Commission;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\System\CurrencyRepository;

class CommissionController extends Controller
{
    
    /**
     * @param CommissionRepository $commissionRepository
     * @return mixed
     */
    public function index(CommissionRepository $commissionRepository)
    {
        return view('backend.services.commission.index')
            ->withCommissions($commissionRepository->getAllCommissions()
                ->paginate());
    }
    
    public function edit(Commission $commission, CurrencyRepository $currencyRepository)
    {
        return view('backend.services.commission.edit')
            ->withCommission($commission)
            ->withCurrencies($currencyRepository->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    public function update(UpdateCommissionRequest $request, CommissionRepository $commissionRepository)
    {
    
    }
    
    /**
     * @param CurrencyRepository $currencyRepository
     * @return mixed
     */
    public function create(CurrencyRepository $currencyRepository)
    {
        return view('backend.services.commission.create')
            ->withCurrencies($currencyRepository->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    /**
     * @param StoreCommissionRequest $request
     * @param CommissionRepository $commissionRepository
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(StoreCommissionRequest $request, CommissionRepository $commissionRepository)
    {
        $commission = $commissionRepository->create($request->input());
    
        return redirect()->route('admin.services.commission.edit', $commission);
    }
}
