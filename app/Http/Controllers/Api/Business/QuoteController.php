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
        sleep(5);
        return response()->json([
            'destination' => $request->input('destination'),
            'amount' => $request->input('amount'),
            'energy' => $request->input('amount') / 100 . ' KWh',
            'fee' => ($request->input('amount') / 100) * 0.025,
            'currency' => $request->input('currency_code'),
        ]);
    }
}
