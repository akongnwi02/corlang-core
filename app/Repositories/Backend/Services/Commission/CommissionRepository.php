<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/24/20
 * Time: 6:43 PM
 */

namespace App\Repositories\Backend\Services\Commission;


use App\Events\Backend\Services\Commission\CommissionCreated;
use App\Exceptions\Api\RangeException;
use App\Exceptions\GeneralException;
use App\Models\Business\Commission;
use App\Models\Business\Pricing;
use Spatie\QueryBuilder\QueryBuilder;

class CommissionRepository
{
    /**
     * @return QueryBuilder
     */
    public function getAllCommissions()
    {
        $commissions = QueryBuilder::for(Commission::class)
            ->with(['pricings' => function ($query) {
                $query->orderBy('from', 'asc')
                    ->orderBy('to', 'asc');
            }])
            ->allowedSorts( 'commissions.name', 'commissions.created_at');
        
        return $commissions;
    }
    
    /**
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function create($data)
    {
        return \DB::transaction(function () use ($data) {
        
            $commission = Commission::create($data);
        
            if ($commission) {
                return $commission;
            }
        
            throw new GeneralException(__('exceptions.backend.companies.company.create_error'));
        });
    }
    
    /**
     * @param Commission $commission
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function update(Commission $commission, $data)
    {
        return \DB::transaction(function () use ($commission, $data) {
            
            $commission->fill($data);
            
            $commission->pricings()->delete();
                
                $pricings = $data['pricings'];
    
                foreach ($pricings as $pricing) {
                $commission->pricings()->save(new Pricing($pricing));
                }
    
            if ($commission->save()) {
                event(new CommissionCreated($commission));
                return $commission;
            }
            
            throw new GeneralException(__('exceptions.backend.services.commission.create_error'));
        });
    }
    
    public function calculateFee(Commission $commission, $amount) : float
    {
        if (is_null($commission)) {
            return 0;
        }
        
        $pricing = $this->getPriceRange($commission->pricings, $amount);
        
        $fee = $pricing->fixed + ($amount * $pricing->precentage) / 100 ;
        
        return $fee;
        
    }
    
    public function getPriceRange($pricings, $amount)
    {
        $availableRange = [];
        
        foreach ($pricings as $pricing) {
            if ($pricing->from <= $amount && $pricing->to >= $amount) {
                $availableRange[] = $pricing;
            }
        }
    
        if (empty($availableRange)) {
            throw new RangeException();
        } else {
            // Return the first item for now
            // return range based on a certain logic
            // for example. The largest to range.
            return $availableRange[0];
        }
    }
}
