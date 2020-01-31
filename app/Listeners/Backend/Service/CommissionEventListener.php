<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/31/20
 * Time: 9:01 AM
 */

namespace App\Listeners\Backend\Service;


class CommissionEventListener
{
    
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Commission Created', [
            'name' => $event->commission->name,
            'by'   => $event->commission->editor->username,
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
            \App\Events\Backend\Services\Commission\CommissionCreated::class,
            'App\Listeners\Backend\Service\CommissionEventListener@onCreated'
        );
    }
}
