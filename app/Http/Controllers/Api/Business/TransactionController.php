<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:53 PM
 */

namespace App\Http\Controllers\Api\Business;


use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\QuoteRequest;
use App\Models\Transaction\Transaction;
use App\Repositories\Api\Business\TransactionRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * @param QuoteRequest $request
     * @param ServiceRepository $serviceRepository
     * @param Transaction $transaction
     * @param TransactionRepository $transactionRepository
     * @return \Illuminate\Http\JsonResponse
     * @throws GeneralException
     */
    public function quote(
        QuoteRequest $request,
        ServiceRepository $serviceRepository,
        Transaction $transaction,
        TransactionRepository $transactionRepository
    )
    {
        $gateway = $serviceRepository->findByCode($request->input('destination_code'))->gateway;
    
        // send synchronous request to micro service
        // if errors, handle with exception
        $response = new \StdClass();
        $response->amount = 5000;
    
        // otherwise set quote to cache
        $transactionRepository->create($request->input());
        $transaction->setQuoteId(\Uuid::generate(4)->string)
            ->setDestination($request->input('destination'))
            ->setDestinationCode($request->input('destination_code'))
            ->setCurrencyCode($request->input('currency_code'))
            ->setAmount($request->input('amount'))
            ->setUserId(auth()->user()->uuid)
            ->setItems($request->input('items'));
    
        // if no errors, save quote to cache with unique quote id
        $ttl = Carbon::now()->addMinutes(config('app.micro_services.cache_expiration'));
    
        $cached = \Cache::store(config('app.micro_services.cache_store'))->add($transaction->uuid, $transaction, $ttl);
    
        if ($cached) {
            return response()->json([
                'id' => $transaction->getQuoteId(),
                'destination' => $request->input('destination'),
                'destination_code' => $request->input('destination_code'),
                'asset' => $request->input('amount') / 100 . ' KWh',
                'amount' => $request->input('amount'),
                'fee' => ($request->input('amount') / 100) * 0.025,
                'currency' => $request->input('currency_code'),
                'items' => [],
                'name' => 'Victor Uchenna',
                'address' => '175 Dondle Street',
                'email' => 'email@test.com',
                'phone' => '653254778',
                'total' => ($request->input('amount') / 100) * 0.025 + $request->input('amount'),
            ]);
        }
    
        throw new GeneralException('error saving item to cache');
    }
    
    public function pay()
    {
    
    }
}
