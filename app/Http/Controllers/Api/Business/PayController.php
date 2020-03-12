<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/12/20
 * Time: 12:38 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\PayRequest;

class PayController extends Controller
{
    public function pay(PayRequest $request)
    {
        // retrieve the transaction from cache based on quote_id
        // create a transaction record
        // return transaction number to client
        // with status of transaction ['queued, in progress, etc']
        // send the request to the micro service
        // wait for response from the micro service
        // broadcast response after the response is received
        // client should receive the broadcast
        
        // if payment account is default
        // check if company and agent account is active
        // check for direct polling and available balance
        //
        // check
        return response([
            'code' => 202,
            'message' => 'Accepted',
        ], 202);
        

    }
}
