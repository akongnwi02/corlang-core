<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/24/20
 * Time: 6:42 PM
 */

namespace App\Http\Controllers\Backend\Services\Commission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Commission\StoreCommissionDistributionRequest;
use App\Http\Requests\Backend\Services\Commission\UpdateCommissionDistributionRequest;
use App\Models\Business\CommissionDistribution;
use App\Repositories\Backend\Services\Commission\CommissionDistributionRepository;

class CommissionDistributionController extends Controller
{
    
    /**
     * @param CommissionDistributionRepository $commissionDistributionRepository
     * @return mixed
     */
    public function index(CommissionDistributionRepository $commissionDistributionRepository)
    {
        return view('backend.services.commission-distribution.index')
            ->withDistributions($commissionDistributionRepository->getAllCommissionDistributions()
                ->paginate());
    }
    
    public function edit(CommissionDistribution $distribution)
    {
        return view('backend.services.commission-distribution.edit')
            ->withDistribution($distribution);
    }
    
    /**
     * @param CommissionDistribution $distribution
     * @param UpdateCommissionDistributionRequest $request
     * @param CommissionDistributionRepository $commissionDistributionRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(CommissionDistribution $distribution, UpdateCommissionDistributionRequest $request, CommissionDistributionRepository $commissionDistributionRepository)
    {
        $commissionDistributionRepository->update($distribution, $request->input());
    
        return redirect()->route('admin.services.distribution.index')
            ->withFlashSuccess(__('alerts.backend.services.distribution.updated'));
    }
    
    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.services.commission-distribution.create');
    }
    
    /**
     * @param StoreCommissionDistributionRequest $request
     * @param CommissionDistributionRepository $commissionDistributionRepository
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreCommissionDistributionRequest $request, CommissionDistributionRepository $commissionDistributionRepository)
    {
        $commissionDistributionRepository->create($request->input());
    
        return redirect()->route('admin.services.distribution.index')
            ->withFlashSuccess(__('alerts.backend.services.distribution.created'));
    
    }
}
