<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:53 PM
 */

namespace App\Http\Controllers\Api\Business;


use App\Events\Api\Business\TransactionPushed;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\ConfirmPaymentRequest;
use App\Http\Requests\Api\Business\QuoteRequest;
use App\Models\Transaction\Transaction;
use App\Repositories\Api\Business\TransactionRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Clients\HttpClient;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * @param QuoteRequest $request
     * @param ServiceRepository $serviceRepository
     * @param Transaction $transaction
     * @param TransactionRepository $transactionRepository
     * @param HttpClient $client
     * @return \Illuminate\Http\JsonResponse
     * @throws GeneralException
     */
    public function quote(
        QuoteRequest $request,
        ServiceRepository $serviceRepository,
        Transaction $transaction,
        TransactionRepository $transactionRepository,
        HttpClient $client
    )
    {
        $gateway = $serviceRepository->findByCode($request->input('service_code'))->gateway;
        $response = $client->post($gateway->url, [
            'body' => $request->input(),
            'headers' => [
                ''
            ]
        ]);
        
//        $response = $gateway->sendGET();

//
//         send synchronous request to micro service
//         if errors, handle with exception
//
//         otherwise set quote to cache
//        $transactionRepository->create($request->input());
        
        
        
        
        $transaction = new Transaction();
        
        $transaction->code = rand();
        $transaction->amount = 5000;
        $transaction->currency_code = 'XAF';
        
        $transaction->save();
        // if no errors, save quote to cache with unique quote id
        $ttl = Carbon::now()->addMinutes(config('app.micro_services.cache_expiration'));
//        dd($transaction->uuid);
        $cached = \Cache::store(config('app.micro_services.cache_store'))->add($transaction->uuid, $transaction, $ttl);
        $cached = \Cache::store(config('app.micro_services.cache_store'))->pull($transaction->uuid);
    
        
        
        if ($cached) {
            return response()->json([
                'id' => $transaction->uuid,
                'uuid' => $transaction->uuid,
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
    
    public function confirm(ConfirmPaymentRequest $request)
    {
        $transaction = Transaction::where('uuid', $request->input('quote_id'))->first();
        event(new TransactionPushed($transaction));
    }
    
    public function status(Transaction $transaction)
    {
    
    }
}
