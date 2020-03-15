<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:37 PM
 */

namespace App\Repositories\Api\Business;


use App\Models\Traits\Methods\TransactionMethod;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class TransactionRepository
{
    public $serviceRepository;
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
    
    public function create($data)
    {
        $customer_fee = $this->serviceRepository->getCustomerFee($data['service_code']);
        
        return Transaction::create([
            'code' => TransactionMethod::generateCode(),
            'destination' => $data['destination'],
            'service_code' => $data['service_code'],
            'currency_code' => $data['currency_code'],
            'amount' => $data['amounnt'],
            'user_id' => auth()->user()->uuid,
            'company_id' => auth()->user()->company_id,
            'items' => serialize($data['items']),
            'customer_fee' => '',
        ]);
    }
}
