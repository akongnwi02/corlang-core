<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/5/20
 * Time: 1:50 PM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\QuoteRequest;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class QuoteController extends Controller
{
    public function quote(QuoteRequest $request, ServiceRepository $serviceRepository)
    {
        // send synchronous request to micro service
        // if error exists, return to client immediately
        // if no errors, save quote to cache generate a quote id
        // return the response with quote id to client
        return response()->json([
            'id' => \Uuid::generate(4)->string,
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
}
