<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 2:11 PM
 */

namespace App\Repositories\Backend\Services\Service;

use App\Events\Backend\Services\Service\ServiceCreated;
use App\Events\Backend\Services\Service\ServiceDeactivated;
use App\Events\Backend\Services\Service\ServiceReactivated;
use App\Events\Backend\Services\Service\ServiceUpdated;
use App\Exceptions\GeneralException;
use App\Models\Service\Service;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ServiceRepository
{
    /**
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $data)
    {
        
        return \DB::transaction(function () use ($data) {
            
            $service = Service::create($data);
            
            if ($service) {
                event(new ServiceCreated($service));
                return $service;
            }
            
            throw new GeneralException(__('exceptions.backend.services.service.create_error'));
        });
    }
    
    /**
     * Returns all the service the user can access.
     * Users in the central service can see all other services
     *
     * @return QueryBuilder
     */
    public function getCompaniesForCurrentUser()
    {
        $companies = QueryBuilder::for(Service::class)
            ->allowedFilters([
                AllowedFilter::scope('active'),
            ])
            ->allowedSorts('services.is_active', 'services.created_at', 'services.name')
            ->defaultSort( '-services.is_active', '-services.is_default', '-services.created_at', 'services.name');
        
        if (! auth()->user()->service->isDefault()) {
            return $companies->select('services.*')
                ->where('users.id', auth()->user()->id)
                ->join('users', 'users.company_id', '=', 'services.uuid');
        }
        
        return $companies;
    }
    
    /**
     * @param $service
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($service, $status)
    {
        // if the service was deactivated by an administrator
        // lesser roles cannot reactivate
        if (! $service->isActive()) {
            if ($service->deactivator->service->isDefault() && ! auth()->user()->isAdmin()) {
                
                throw new GeneralException(__('exceptions.backend.services.service.mark_rights_error'));
            }
        }
        
        $service->is_active = $status;
        
        if ($service->save()) {
            
            switch ($status) {
                case 0:
                    event(new ServiceDeactivated($service));
                    break;
                
                case 1:
                    event(new ServiceReactivated($service));
                    break;
            }
            
            return $service;
        }
        
        throw new GeneralException(__('exceptions.backend.services.service.mark_error'));
    }
    
    /**
     * @param $service
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function update($service, $data, $logo = null)
    {
        
        $service->fill($data);
        
        if ($logo) {
            // delete previous logo
            if (strlen($service->logo_url)) {
                Storage::disk('public')->delete($service->logo_url);
            }
            
            $service->logo_url = $logo->store('/logos', 'public');
            
        }
        
        if ($service->update()) {
            
            event(new ServiceUpdated($service));
            
            return $service;
        }
        
        throw new GeneralException(__('exceptions.backend.services.service.update_error'));
    }
}
