<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 10:12 AM
 */

namespace App\Repositories\Backend\System;

use App\Exceptions\GeneralException;
use App\Models\System\Currency;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CurrencyRepository
{

    public function get()
    {
        $currency = QueryBuilder::for(Currency::class)
            ->allowedFilters([
                AllowedFilter::exact('is_active'),
                AllowedFilter::exact('is_default'),
            ])
            ->allowedSorts('is_active', 'created_at', 'name')
            ->defaultSort('-is_active', '-is_default', 'name');
        return $currency;
    }
    
    public function findByCode($code)
    {
        return Currency::where('code', $code)->first();
    }
    
    /**
     * @param $currency
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($currency, $status)
    {
        $currency->is_active = $status;
    
        if ($currency->save()) {
        
            switch ($status) {
                case 0:
//                    event(new CurrencyDeactivated($category));
                    break;
            
                case 1:
//                    event(new CurrencyReactivated($category));
                    break;
            }
        
            return $currency;
        }
    
        throw new GeneralException(__('exceptions.backend.administration.currency.mark_error'));
    }
    
    /**
     * @param $currency
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($currency, $data)
    {
        $currency->fill($data);
    
        if ($currency->save()) {
//            event(new CategoryUpdated($method));
            return $currency;
        }
    
        throw new GeneralException(__('exceptions.backend.administration.currency.update_error'));
    }
    
    /**
     * @param $data
     * @return Currency
     * @throws GeneralException
     */
    public function create($data)
    {
        $currency = (new Currency())->fill($data);
    
        if ($currency->save()) {
//            event(new PaymentMethodCreated($method));
            return $currency;
        }
    
        throw new GeneralException(__('exceptions.backend.administration.currency.create_error'));
    }
}
