<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/26/20
 * Time: 9:54 PM
 */

namespace App\Listeners\Backend\Service;


class ServiceEventListener
{
    
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Service Created', [
            'name' => $event->service->name,
            'by'   => $event->service->creator->username,
        ]);
    }
    
    public function onUpdated($event)
    {
        \Log::info('Service Updated', [
            'name' => $event->service->name,
            'by'   => $event->service->editor->username,
        ]);
    }
    
    public function onReactivated($event)
    {
        \Log::info('Service Reactivated', [
            'name' => $event->service->name,
            'by'   => $event->service->editor->username,
        ]);
    }
    
    public function onDeactivated($event)
    {
        \Log::info('Service Deactivated', [
            'name' => $event->service->name,
            'by'   => $event->service->editor->username,
        ]);
    }
    
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Services\Service\ServiceCreated::class,
            'App\Listeners\Backend\Service\ServiceEventListener@onCreated'
        );
        
        $events->listen(
            \App\Events\Backend\Services\Service\ServiceReactivated::class,
            'App\Listeners\Backend\Service\ServiceEventListener@onReactivated'
        );
        
        $events->listen(
            \App\Events\Backend\Services\Service\ServiceDeactivated::class,
            'App\Listeners\Backend\Service\ServiceEventListener@onDeactivated'
        );
        
        $events->listen(
            \App\Events\Backend\Services\Service\ServiceUpdated::class,
            'App\Listeners\Backend\Service\ServiceEventListener@onUpdated'
        );
    }
}
