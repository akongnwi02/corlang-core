<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/26/20
 * Time: 1:06 AM
 */

namespace App\Jobs\Business;

use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Business\Validators\CategoryTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,
        CategoryTrait;
 
    public $transaction;
    
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    
    /**
     * @param ServiceRepository $serviceRepository
     * @throws \App\Exceptions\Api\ServerErrorException
     */
    public function handle(ServiceRepository $serviceRepository)
    {
        $service = $serviceRepository->findByCode($this->transaction->service_code);
    
        $categoryClient = $this->category($service->category);
        
//        $categoryClient->validate();
    }
}
