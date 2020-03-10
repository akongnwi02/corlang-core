<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:15 PM
 */

namespace App\Listeners\Backend\Company;

class CompanyEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Company Created', [
            'name' => $event->company->name,
            'by' => $event->company->creator->username,
            'type' => $event->company->type->name,
        ]);
    }
    
    public function onUpdated($event)
    {
        \Log::info('Company Updated', [
            'name' => $event->company->name,
            'by' => $event->company->editor->username,
            'type' => $event->company->type->name,
        ]);
    }
    
    public function onReactivated($event)
    {
        \Log::info('Company Reactivated', [
            'name' => $event->company->name,
            'by' => $event->company->editor->username,
        ]);
    }
    
    public function onDeactivated($event)
    {
        \Log::info('Company Deactivated', [
            'name' => $event->company->name,
            'by' => $event->company->editor->username,
        ]);
    }
    
    public function onServiceReactivated($event)
    {
        \Log::info('Company Service Reactivated', [
            'company' => $event->company->name,
            'service' => $event->service->name,
        ]);
    }
    
    public function onServiceDeactivated($event)
    {
        \Log::info('Company Service Deactivated', [
            'company' => $event->company->name,
            'service' => $event->service->name,
        ]);
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Companies\Company\CompanyCreated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onCreated'
        );
        
        $events->listen(
            \App\Events\Backend\Companies\Company\CompanyReactivated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onReactivated'
        );
        
        $events->listen(
            \App\Events\Backend\Companies\Company\CompanyDeactivated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onDeactivated'
        );
        
        $events->listen(
            \App\Events\Backend\Companies\Company\CompanyUpdated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onUpdated'
        );
        
        $events->listen(
            \App\Events\Backend\Companies\Service\ServiceDeactivated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onServiceDeactivated'
        );
        $events->listen(
            \App\Events\Backend\Companies\Service\ServiceReactivated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onServiceReactivated'
        );
    }
}
