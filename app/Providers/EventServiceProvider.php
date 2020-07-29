<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        /*
         * Frontend Subscribers
         */

        /*
         * Auth Subscribers
         */
        \App\Listeners\Frontend\Auth\UserEventListener::class,

        /*
         * Backend Subscribers
         */
        \App\Listeners\Backend\Company\CompanyEventListener::class,
        \App\Listeners\Backend\Service\ServiceEventListener::class,
        \App\Listeners\Backend\Service\CommissionEventListener::class,
        \App\Listeners\Backend\Account\AccountEventListener::class,
        \App\Listeners\Backend\Movement\MovementEventListener::class,
        
        /*
         * Api Subscribers
         */
        \App\Listeners\Api\Merchant\OrderEventListener::class,
        
        /*
         * Auth Subscribers
         */
        \App\Listeners\Backend\Auth\User\UserEventListener::class,
        \App\Listeners\Backend\Auth\Role\RoleEventListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
