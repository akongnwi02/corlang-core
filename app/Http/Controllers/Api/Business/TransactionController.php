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
use App\Http\Requests\Api\Business\DeleteTransactionRequest;
use App\Http\Requests\Api\Business\ShowTransactionRequest;
use App\Http\Requests\Api\Business\GeneralRequest;
use App\Http\Resources\Api\Business\PostpaidBillResource;
use App\Http\Resources\Api\TransactionResource;
use App\Jobs\Business\Purchase\ProcessPurchaseJob;
use App\Models\Transaction\Transaction;
use App\Repositories\Api\Business\TransactionRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Business\Models\ModelInterface;
use App\Services\Business\Models\PostpaidBill;
use App\Services\Business\Validators\CategoryProvider;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    use CategoryProvider;
    
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
        \Log::info('New quote request received. Processing the quote request ... ');
    
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
    
            \Log::info('Quote saved to cache successfully. Sending response to client');
    
            return $categoryClient->response($model);
        }
        
        throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_SAVE_TO_CACHE_ERROR);
    }
    
    /**
     * @param ConfirmPaymentRequest $request
     * @param TransactionRepository $transactionRepository
     * @return TransactionResource
     * @throws NotFoundException
     * @throws \App\Exceptions\Api\BadRequestException
     * @throws \Throwable
     */
    public function confirm(ConfirmPaymentRequest $request, TransactionRepository $transactionRepository)
    {
        /** @var ModelInterface $model */
        $model = \Cache::store(config('app.micro_services.cache_store'))->pull($request->input('quote_id'));
        
        if ($model) {
            \Log::info('Purchase confirmation request received. Dispatching transaction to queue');
            
            $transaction = $transactionRepository->findByUuid($model->getTransactionId());
            
            $transactionRepository->processPayment($transaction);
            
            $transaction->status = config('business.transaction.status.pending');
            $transaction->save();
            
            dispatch(new ProcessPurchaseJob($transaction))->onQueue(config('business.transaction.queue.purchase.process'));
            
            return new TransactionResource($transaction);
        }
        
        throw new NotFoundException(BusinessErrorCodes::TRANSACTION_NOT_IN_CACHE, 'This transaction is no longer in cache. May have expired or already processed');
    }
    
    /**
     * @param ServiceRepository $serviceRepository
     * @param GeneralRequest $request
     * @return mixed
     * @throws ServerErrorException
     */
    public function search(ServiceRepository $serviceRepository, GeneralRequest $request)
    {
        \Log::info('New search request received. Processing the search request... ');
    
        $service = $serviceRepository->findByCode($request->input('service_code'));
    
        $categoryClient = $this->category($service->category);
    
        $result = $categoryClient->search($request->input());
    
        $ttl = Carbon::now()->addMinutes(config('app.micro_services.cache_expiration'));
    
        \Cache::store(config('app.micro_services.cache_store'))->put($request->input('destination'), $result, $ttl);
        
        return $categoryClient->resultResponse($result);
    }
    
    /**
     * @param ShowTransactionRequest $request
     * @param Transaction $transaction
     * @return TransactionResource
     */
    public function show(ShowTransactionRequest $request, Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }
    
    /**
     * @param DeleteTransactionRequest $request
     * @param Transaction $transaction
     * @return bool|null
     * @throws ServerErrorException
     */
    public function delete(DeleteTransactionRequest $request,Transaction $transaction)
    {
        if ($transaction->delete()) {
            return response()->json([], 204);
        }
        throw new ServerErrorException(BusinessErrorCodes::GENERAL_CODE, 'There was a problem deleting this transaction');
    }
    
    public function index(TransactionRepository $transactionRepository)
    {
        $transactions = $transactionRepository->getAgentTransactions()
            // Limit the transactions to just 20 to save bandwidth
            ->limit(20)
            ->get();
        
        return TransactionResource::collection($transactions);
    }
}
