<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:15 PM
 */

namespace App\Listeners\Backend\Company;

use App\Notifications\Backend\Company\Company\CompanyCreated;

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
    
    public function onReactivated($event)
    {
        $event->company->deactivated_by_id = null;

        $event->company->save();
        
        \Log::info('Company Reactivated', [
            'name' => $event->company->name,
            'by' => $event->company->editor->username,
        ]);
    }
    
    public function onDeactivated($event)
    {
        $event->company->deactivated_by_id = $event->company->editor->uuid;
    
        $event->company->save();
    
        \Log::info('Company Deactivated', [
            'name' => $event->company->name,
            'by' => $event->company->editor->username,
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
            \App\Events\Backend\Company\Company\CompanyCreated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onCreated'
        );
        
        $events->listen(
            \App\Events\Backend\Company\Company\CompanyReactivated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onReactivated'
        );
        
        $events->listen(
            \App\Events\Backend\Company\Company\CompanyDeactivated::class,
            'App\Listeners\Backend\Company\CompanyEventListener@onDeactivated'
        );
    }
}
