<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:53 PM
 */

namespace App\Http\Controllers\Api\Business;

use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\ServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\ConfirmPaymentRequest;
use App\Http\Requests\Api\Business\GeneralRequest;
use App\Models\Transaction\Transaction;
use App\Repositories\Api\Business\TransactionRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Business\Validators\CategoryTrait;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    use CategoryTrait;
    
    /**
     * @param GeneralRequest $request
     * @param ServiceRepository $serviceRepository
     * @param TransactionRepository $transactionRepository
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function quote(
        GeneralRequest $request,
        ServiceRepository $serviceRepository,
        TransactionRepository $transactionRepository
    )
    {
        $service = $serviceRepository->findByCode($request['service_code']);
    
        $categoryClient = $this->category($service->category);
        
        $categoryClient->validate($request->input());
        
        $model = $categoryClient->quote($request->input());
        
        $transaction = $transactionRepository->create($model);
    
        $model->setTransactionId($transaction->uuid);
        $model->setCustomerFee($transaction->total_customer_fee);
        
        $ttl = Carbon::now()->addMinutes(config('app.micro_services.cache_expiration'));
        
        $cached = \Cache::store(config('app.micro_services.cache_store'))->add($model->getTransactionId(), $model, $ttl);
    
        if ($cached) {
            return $categoryClient->response($model);
        }
    
        throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_SAVE_TO_CACHE_ERROR);
    }
    
    public function confirm(ConfirmPaymentRequest $request)
    {
        $model = \Cache::store(config('app.micro_services.cache_store'))->pull($request->input('quote_id'));
        
        if ($model) {
            \Log::info('Transaction retrieved from cache successfully. Dispatching transaction to queue');
            
            dispatch();
        }
    
        throw new NotFoundException(BusinessErrorCodes::TRANSACTION_NOT_IN_CACHE, 'This transaction is no longer in cache. May have expired or already processed');
    }
    
    public function status(Transaction $transaction)
    {
    
    }
    
    public function httpClient()
    {
    
    }
}
