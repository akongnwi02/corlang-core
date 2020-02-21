<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 10:26 PM
 */

namespace App\Listeners\Backend\Account;


class AccountEventListener
{
    
    public function onReactivated($event)
    {
        \Log::info('Account Reactivated', [
            'id' => $event->account->uuid,
        ]);
    }
    
    public function onDeactivated($event)
    {
        \Log::info('Account Deactivated', [
            'id' => $event->account->uuid,
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
            \App\Events\Backend\Account\AccountReactivated::class,
            'App\Listeners\Backend\Account\AccountEventListener@onReactivated'
        );
        
        $events->listen(
            \App\Events\Backend\Account\AccountDeactivated::class,
            'App\Listeners\Backend\Account\AccountEventListener@onDeactivated'
        );
        
    }
}
