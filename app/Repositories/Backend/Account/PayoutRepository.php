<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 5:16 PM
 */

namespace App\Repositories\Backend\Account;


use App\Exceptions\GeneralException;
use App\Models\Account\Payout;
use App\Models\Account\PayoutType;
use Spatie\QueryBuilder\QueryBuilder;

class PayoutRepository
{
    /**
     * Transfer money from a user account to company strongbox
     *
     * @param $account
     * @param $data
     * @return bool
     * @throws GeneralException
     */
    public function drainAccount($account, $data)
    {
        $drain = new Payout();
        $drain->code = Payout::generateCode();
        $drain->amount = $data['amount'];
        $drain->comment = $data['comment'];
        $drain->type_id = PayoutType::where('name', config('business.payout.type.drain'))->first()->uuid;
        $drain->user_id = auth()->user()->uuid;
        $drain->company_id = auth()->user()->company->uuid;
        $drain->currency_id = $data['currency_id'];
        $drain->account_id = $account->uuid;
        
        if(! $account->user->company){
            throw new GeneralException(__('exceptions.backend.payout.no_company_error'));
        }
        
        $strongbox = $account->user->company->strongbox;
        $strongbox->balance += $data['amount'];
        
        if ($drain->save() && $strongbox->save()) {
//            event(new AccountDrained());
            return true;
        }
    
        throw new GeneralException(__('exceptions.backend.payout.transfer_error'));
    }
    
    /**
     * @param $account
     * @param $data
     * @return bool
     * @throws GeneralException
     */
    public function payout($account, $data)
    {
        $payout = new Payout();
        $payout->code = Payout::generateCode();
        $payout->amount = $data['amount'];
        $payout->comment = $data['comment'];
        $payout->account_number = $data['account_number'];
        $payout->paymentmethod_id = $data['paymentmethod_id'];
        $payout->currency_id = $data['currency_id'];
        $payout->type_id = PayoutType::where('name', config('business.payout.type.commission'))->first()->uuid;
        $payout->user_id = auth()->user()->uuid;
        $payout->company_id = auth()->user()->company->uuid;
        $payout->account_id = $account->uuid;
        $payout->status = $account->is_default ? config('business.payout.status.approved') : config('business.payout.status.pending');
    
        if ($payout->save()) {
            // event(new PayoutRequest());
            return true;
        }
    
        throw new GeneralException(__('exceptions.backend.payout.payout_error'));
    }
    
    /**
     * @param $payout
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($payout, $status)
    {
        $payout->status = $status;
    
        if ($payout->update()) {
        
//            switch ($status) {
//                case config('business.payout.status.approved'):
//                    event(new PayoutApproved($payout));
//                    break;
//
//                case config('business.payout.status.rejected'):
//                    event(new PayoutRejected($payout));
//                    break;
//
//                case config('business.payout.status.cancelled'):
//                    event(new PayoutCancelled($payout));
//                    break;
//            }
        
            return $payout;
        }
    
        throw new GeneralException(__('exceptions.backend.payout.status_error'));
    }
    
    public function getAccountDrains($account)
    {
        return QueryBuilder::for(Payout::class)
            ->where('account_id', $account->uuid)
            ->where('type_id', PayoutType::where('name', config('business.payout.type.drain'))->first()->uuid)
            ->defaultSort('-payouts.created_at');
    }
    
    public function getAllPayouts($account)
    {
        return QueryBuilder::for(Payout::class)
            ->where('account_id', $account->uuid)
            ->where('type_id', PayoutType::where('name', config('business.payout.type.commission'))->first()->uuid)
            ->defaultSort('-payouts.created_at');
    }
}
