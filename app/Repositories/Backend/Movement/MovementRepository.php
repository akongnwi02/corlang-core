<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 8:15 PM
 */

namespace App\Repositories\Backend\Movement;

use App\Events\Backend\Movement\MovementCreated;
use App\Exceptions\GeneralException;
use App\Models\Account\Account;
use App\Models\Account\Movement;
use App\Models\Account\MovementType;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MovementRepository
{
    /**
     * @param $account
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function floatAccount($account, $data)
    {
        return \DB::transaction(function () use ($account, $data) {
    
            $movement = new Movement();
            $movement->code = Movement::generateCode();
            $movement->amount = $data['amount'];
            $movement->type_id = MovementType::where('name', config('business.movement.type.float'))->firstOrFail()->uuid;
            $movement->user_id = auth()->user()->uuid;
            $movement->company_id = auth()->user()->company->uuid;
            $movement->currency_id = $data['currency_id'];
            $movement->destinationaccount_id = $account->uuid;
        
            if ($movement->save()) {
                event(new MovementCreated($movement));
                return $movement;
            }
        
            throw new GeneralException(__('exceptions.backend.movement.create_error'));
        });
    }
    
    public function getAccountBalance($account)
    {
        $credit = Movement::where('destinationaccount_id', $account->uuid)
            ->where('type_id', MovementType::where('name', config('business.movement.type.float'))->firstOrFail()->uuid)
            ->orWhere('type_id', MovementType::where('name', config('business.movement.type.deposit'))->firstOrFail()->uuid)
            ->orWhere('type_id', MovementType::where('name', config('business.movement.type.sale'))->firstOrFail()->uuid)
            ->sum('amount');
    
        $debit = Movement::where('sourceaccount_id', $account->uuid)
            ->where('type_id', MovementType::where('name', config('business.movement.type.float'))->firstOrFail()->uuid)
            ->orWhere('type_id', MovementType::where('name', config('business.movement.type.deposit'))->firstOrFail()->uuid)
            ->orWhere('type_id', MovementType::where('name', config('business.movement.type.sale'))->firstOrFail()->uuid)
            ->sum('amount');
    
        return $credit - $debit;
    }
    
    public function getCompanyCommissionBalance($company)
    {
        $credit = Movement::where('company_id', $company->uuid)
            ->where('type_id', MovementType::where('name', config('business.movement.type.sale'))->firstOrFail()->uuid)
            ->whereNotIn('type_id', [MovementType::where('name', config('business.movement.type.reversal'))->firstOrFail()->uuid])
            ->sum('company_commission');
    
        $debit = Movement::where('company_id', $company->uuid)
            ->where('type_id', MovementType::where('name', config('business.movement.type.sale'))->firstOrFail()->uuid)
            ->where('type_id', MovementType::where('name', config('business.movement.type.reversal'))->firstOrFail()->uuid)
            ->sum('company_commission');
    
        return $credit - $debit;
    }
    
    public function getCompanyTodaysCommission($company)
    {
        return 0;
    }
    
    public function getAccountMovements($account)
    {
        $movements = QueryBuilder::for(Movement::class)
            ->where('sourceaccount_id', $account->uuid)
            ->orWhere('destinationaccount_id', $account->uuid)
            ->whereNotIn('type_id', [MovementType::where('name', config('business.movement.type.sale'))->first()->uuid])
            ->defaultSort('-movements.created_at');
    
        return $movements;
    }
}
