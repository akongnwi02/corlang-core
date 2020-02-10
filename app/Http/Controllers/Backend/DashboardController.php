<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\System\Currency;
use App\Repositories\Backend\Movement\MovementRepository;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @param MovementRepository $movementRepository
     * @return \Illuminate\View\View
     */
    public function index(MovementRepository $movementRepository)
    {
        return view('backend.dashboard')
            ->withNumberOfUsers(auth()->user()->company->getNumberOfUsers())
            ->withCompanyBalance(number_format($movementRepository->getAccountBalance(auth()->user()->company->account),2))
            ->withCompanyCommission(number_format($movementRepository->getCompanyCommissionBalance(auth()->user()->company),2))
            ->withCompanyTodayCommission(number_format($movementRepository->getCompanyTodaysCommission(auth()->user()->company),2))
            ->withCurrency(Currency::where('is_default', true)->firstOrFail());
    }
}
