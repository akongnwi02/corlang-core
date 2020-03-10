<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/5/20
 * Time: 1:50 PM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Requests\Api\Business\QuoteRequest;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class QuoteController
{
    public function quote(QuoteRequest $request, ServiceRepository $serviceRepository)
    {
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
