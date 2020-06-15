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
use App\Models\Service\Item;
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
    public function create(array $data, $logo)
    {
        return \DB::transaction(function () use ($data, $logo) {
            
            $service = (new Service)->fill($data);
            $service->has_items = request()->has('has_items') ? 1 : 0;
            
//            if ($logo) {
//
//                $service->logo_url = $logo->store('/logos', 'public');
//
//            }
    
            if ($service->save()) {
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
    public function getAllServices()
    {
        $services = QueryBuilder::for(Service::class)
            ->allowedFilters([AllowedFilter::exact('is_active')])
            ->allowedSorts('services.is_active', 'services.created_at', 'services.name')
            ->defaultSort( '-services.is_active', '-services.created_at', 'services.name');
        return $services;
    }
    
    /**
     * @param $service
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($service, $status)
    {
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
     * @param Service $service
     * @param $data
     * @param null $logo
     * @return mixed
     * @throws \Throwable
     */
    public function update(Service $service, $data, $logo = null)
    {
        return \DB::transaction(function () use ($service, $data, $logo) {
            
            if ($service->has_items) {
                $items = $data['items'];
                $service->items()->delete();
                foreach ($items as $item) {
                    $item['is_active'] = array_key_exists('is_active', $item) ? $item['is_active'] : 0;
                    $item['service_id'] = $service->uuid;
    
                    $service->items()->save(new Item($item));
                }
            }
    
            $service->fill($data);
            $service->has_items = request()->has('has_items') ? 1 : 0;
            $service->requires_auth = request()->has('requires_auth') ? 1 : 0;
            $service->is_money_withdrawal = request()->has('is_money_withdrawal') ? 1 : 0;
    
//            if ($logo) {
//                // delete previous logo
//                if (strlen($service->logo_url)) {
//                Storage::disk('public')->delete($service->logo_url);
//                }
//
//                $service->logo_url = $logo->store('/logos', 'public');
//
//            }
    
            if ($service->update()) {
        
                event(new ServiceUpdated($service));
        
                return $service;
            }
    
            throw new GeneralException(__('exceptions.backend.services.service.update_error'));
        });
    }
    
    public function getAllActiveServices()
    {
        return Service::active();
    }
    
    public function findByCode($code)
    {
        return Service::where('code', $code)->first();
    }
    
    public function getAgentServiceRate($service, $company)
    {
        return $company->services()->where('uuid', $service->uuid)->first()->specific->agent_rate ?: $service->agent_rate;
    }
    
    public function getCompanyServiceRate($service, $company)
    {
        return $company->services()->where('uuid', $service->uuid)->first()->specific->company_rate ?: $service->company_rate;
    }
    
    public function getExternalServiceRate($service, $company)
    {
        return $company->services()->where('uuid', $service->uuid)->first()->specific->external_rate ?: $service->external_rate;
    }
    
}
