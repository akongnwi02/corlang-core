<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/12/20
 * Time: 12:38 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Events\Api\Business\TransactionPushed;
use App\Exceptions\Api\DuplicateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\PayRequest;
use App\Models\Transaction\Transaction;

class PayController extends Controller
{
    /**
     * @param PayRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws DuplicateException
     */
    public function pay(PayRequest $request)
    {
    
        /** @var Transaction $transaction */
        $transaction = \Cache::store(config('app.micro_services.cache_store'))->pull($request->input('quote_id'));
        
        if (! $transaction) {
            throw new DuplicateException();
        }
    
        $transaction->setPaymentMethodCode($request->input('source_code'));
        $transaction->setAccountNumber($request->input('destination'));
        $transaction->setReference($request->input('reference'));
        
        // create a transaction record in db
        // put transaction in queue
        // return transaction record to client
        // with status of transaction ['queued, in progress, etc']
        // start worker
        // send the request to the micro service
        // if sent successfully update db status to e.g processing and delete from queue
        // if failed due to validation for example, update status to failed, delete from queue. and exit
        // wait for callback from the micro service and update status
        // broadcast response after the response is received
        // client should receive the broadcast
        
        // if payment account is default
        // check if company and agent account is active
        // check for direct polling and available balance
        
        return response([
            'code' => 202,
            'message' => 'Accepted',
        ], 202);
        

    }
}
