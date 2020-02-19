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
        
        if ($drain->save()) {
            return true;
        }
    
        throw new GeneralException(__('exceptions.backend.movement.create_error'));
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
