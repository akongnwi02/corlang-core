<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/2/20
 * Time: 1:02 AM
 */

namespace App\Repositories\Backend\Accounting;


use App\Exceptions\GeneralException;
use App\Models\Account\BillerPayment;
use App\Models\Account\PayoutType;
use Spatie\QueryBuilder\QueryBuilder;

class BillerPaymentRepository
{
    public function get()
    {
        return QueryBuilder::for(BillerPayment::class);
    }
    
    /**
     * @param $service
     * @param $data
     * @return bool
     * @throws GeneralException
     */
    public function payout($service, $data)
    {
        $billerPayment = new BillerPayment();
        $billerPayment->code = BillerPayment::generateCode();
        $billerPayment->amount = $data['amount'];
        $billerPayment->comment = $data['comment'];
        $billerPayment->type_id = PayoutType::where('name', config('business.payout.type.collection'))->first()->uuid;
        $billerPayment->user_id = auth()->user()->uuid;
        $billerPayment->currency_id = $data['currency_id'];
        $billerPayment->service_id = $service->uuid;
    
        if ($billerPayment->save()) {
//            event(new AccountDrained());
            return true;
        }
    
        throw new GeneralException(__('exceptions.backend.accounting.collection_payment_error'));
    }
    
    /**
     * @param $service
     * @param $data
     * @return bool
     * @throws GeneralException
     */
    public function request($service, $data)
    {
        $billerPayment = new BillerPayment();
        $billerPayment->code = BillerPayment::generateCode();
        $billerPayment->amount = $data['amount'];
        $billerPayment->comment = $data['comment'];
        $billerPayment->type_id = PayoutType::where('name', config('business.payout.type.provision'))->first()->uuid;
        $billerPayment->user_id = auth()->user()->uuid;
        $billerPayment->currency_id = $data['currency_id'];
        $billerPayment->service_id = $service->uuid;
    
        if ($billerPayment->save()) {
//            event(new AccountDrained());
            return true;
        }
        throw new GeneralException(__('exceptions.backend.accounting.provision_request_error'));
    
    }
}
