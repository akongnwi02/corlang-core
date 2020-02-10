<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 11:16 PM
 */

namespace App\Listeners\Backend\Movement;

class MovementEventListener
{
    public function onCreated($event)
    {
        \Log::info('Movement Created', [
            'id' => $event->movement->uuid,
            'by' => $event->movement->creator->uuid,
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
            \App\Events\Backend\Movement\MovementCreated::class,
            'App\Listeners\Backend\Movement\MovementEventListener@onCreated'
        );
    }
}
