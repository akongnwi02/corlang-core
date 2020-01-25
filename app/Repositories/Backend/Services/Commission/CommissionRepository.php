<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/24/20
 * Time: 6:43 PM
 */

namespace App\Repositories\Backend\Services\Commission;


use App\Exceptions\GeneralException;
use App\Models\Business\Commission;
use Spatie\QueryBuilder\QueryBuilder;

class CommissionRepository
{
    /**
     * Returns all the service the user can access.
     * Users in the central service can see all other services
     *
     * @return QueryBuilder
     */
    public function getAllCommissions()
    {
        $commissions = QueryBuilder::for(Commission::class)
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
}
