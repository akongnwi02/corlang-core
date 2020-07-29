<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/12/20
 * Time: 10:45 PM
 */

namespace App\Http\Controllers\Api\Business;

use App\Exceptions\Api\ServerErrorException;
use App\Http\Controllers\Controller;
use App\Jobs\Business\Purchase\CompletePurchaseJob;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     * @throws ServerErrorException
     */
    public function callback(Request $request, Transaction $transaction)
    {
        \Log::info('New callback request received', [
            'ip'      => $request->ip(),
            'payload' => $request->input()
        ]);
        
        $this->handleTransactionCallback($transaction, $request);
        
        \Log::info('Inserting transaction to COMPLETE queue');
        
        $transaction->refresh();
        
        dispatch(new CompletePurchaseJob($transaction))->onQueue(config('business.transaction.queue.purchase.complete'));
    
        return $this->callbackSuccessResponse();

    }
}
