<?php


namespace App\Http\Controllers\Backend\Services\Balance;


use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Clients\CategoryProvider;

class BalanceController
{
    use CategoryProvider;

    /**
     * @param ServiceRepository $serviceRepository
     * @return mixed
     */
    public function index(ServiceRepository $serviceRepository)
    {
        \Log::info('New request to get service balances');

        $balanceServices = $serviceRepository->getServicesWithBalanceSupport()->get();
        foreach ($balanceServices as $service) {
            try {
                $categoryClient = $this->category($service->category);

                $balance = $categoryClient->balance($service);
                $service->current_balance = $balance->current_balance;
                $service->balance_requested_at = $balance->time_requested;

            } catch (\Exception $exception) {
                $service->current_balance = null;
                $service->balance_requested_at = null;
                \Log::error("Balance check for the service $service->name failed", ['error' => $exception->getMessage()]);
            }
        }
        return view('backend.services.balance.index')
            ->withServices($balanceServices);
    }
}
