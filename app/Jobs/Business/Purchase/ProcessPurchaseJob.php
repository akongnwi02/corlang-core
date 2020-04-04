<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/2/20
 * Time: 9:26 PM
 */

namespace App\Jobs\Business\Purchase;

use App\Jobs\Job;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class ProcessPurchaseJob extends Job
{
    public $transaction;
    
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    
    public function handle(ServiceRepository $serviceRepository)
    {
        $service = $serviceRepository->findByCode($this->transaction->service_code);
    
        $categoryClient = $this->category($service->category);
        
        $categoryClient->confirm();
    }
}
