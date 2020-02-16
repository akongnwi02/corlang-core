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
use function foo\func;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * The account movements are referenced by the destination. e.g withdrawal and deposit used indicate debit or credit
 * on the destination account
 *
 * Class MovementRepository
 * @package App\Repositories\Backend\Movement
 *
 */
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
        $movement = new Movement();
        $movement->code = Movement::generateCode();
        $movement->amount = $data['amount'];
        $movement->type_id = MovementType::where('name', config('business.movement.type.float'))->first()->uuid;
        $movement->user_id = auth()->user()->uuid;
        $movement->company_id = auth()->user()->company->uuid;
        $movement->currency_id = $data['currency_id'];
        $movement->destinationaccount_id = $account->uuid;
    
        if ($movement->save()) {
            event(new MovementCreated($movement));
            return $movement;
        }
    
        throw new GeneralException(__('exceptions.backend.movement.create_error'));
    }
    
    /**
     * @param $account
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function creditAccount($account, $data)
    {
        $movement = new Movement();
        $movement->code = Movement::generateCode();
        $movement->amount = $data['amount'];
        $movement->type_id = MovementType::where('name', config('business.movement.type.deposit'))->first()->uuid;
        $movement->user_id = auth()->user()->uuid;
        $movement->company_id = auth()->user()->company->uuid;
        $movement->currency_id = $data['currency_id'];
        $movement->sourceaccount_id = $data['direction'] == 'IN' ? auth()->user()->company->account->uuid : $account->uuid;
        $movement->destinationaccount_id = $data['direction'] == 'OUT' ? auth()->user()->company->account->uuid : $account->uuid;
        
        $double = clone $movement;
        $double->type_id = MovementType::where('name', config('business.movement.type.withdrawal'))->first()->uuid;
        $double->sourceaccount_id = $movement->destinationaccount_id;
        $double->destinationaccount_id = $movement->sourceaccount_id;
    
        return \DB::transaction(function () use ($movement, $double) {
    
            if ($movement->save() && $double->save()) {
                return true;
            }
            
            throw new GeneralException(__('exceptions.backend.movement.create_error'));
        });
    }
    
    public function getAccountBalance($account)
    {
        $credit = Movement::where('is_reversed', false)
            ->where('destinationaccount_id', $account->uuid)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.float'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.deposit'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.sale'))->first()->uuid);
            })
            ->sum('amount');
    
        $debit = Movement::where('is_reversed', false)
            ->where('destinationaccount_id', $account->uuid)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.purchase'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.withdrawal'))->first()->uuid);
            })
            ->sum('amount');
    
        return ($credit-$debit);
    }
    
    public function getCompanyCommissionBalance($company)
    {
        $commission = Movement::where('company_id', $company->uuid)
            ->where('is_reversed', false)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.sale'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.purchase'))->first()->uuid);
            })
            ->sum('company_commission');
        
        return $commission;
    }
    
    public function getCompanyTodaysCommission($company)
    {
        return 0;
    }
    
    public function getAccountMovements($account)
    {
        $movements = QueryBuilder::for(Movement::class)
            ->where('destinationaccount_id', $account->uuid)
            ->whereNotIn('type_id', [MovementType::where('name', config('business.movement.type.sale'))->first()->uuid])
            ->defaultSort('-movements.created_at');
    
        return $movements;
    }
}
