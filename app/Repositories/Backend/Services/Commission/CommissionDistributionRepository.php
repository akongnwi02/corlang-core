<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/29/20
 * Time: 11:49 PM
 */

namespace App\Repositories\Backend\Services\Commission;


use App\Exceptions\GeneralException;
use App\Models\Business\CommissionDistribution;
use Spatie\QueryBuilder\QueryBuilder;

class CommissionDistributionRepository
{
    /**
     * @return QueryBuilder
     */
    public function getAllCommissionDistributions()
    {
        return QueryBuilder::for(CommissionDistribution::class)

            ->allowedSorts( 'name', 'created_at');
    }
    
    /**
     * @param $distribution
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($distribution, $data)
    {
            $distribution->fill($data);
        
            if ($distribution->save()) {
//                event(new CommissionDistributionUpdated($distribution));
                return $distribution;
            }
        
            throw new GeneralException(__('exceptions.backend.services.distribution.update_error'));
        
    }
    
    /**
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function create($data)
    {
            $distribution = CommissionDistribution::create($data);
        
            if ($distribution->save()) {
//                event(new CommissionDistributionCreated($distribution));
                return $distribution;
            }
        
            throw new GeneralException(__('exceptions.backend.services.distribution.create_error'));
        
    }
}
