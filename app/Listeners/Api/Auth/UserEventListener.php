<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/7/19
 * Time: 8:54 AM
 */

namespace App\Listeners\Api\Auth;

use Carbon\Carbon;

class UserEventListener
{
    /**
     * @param $event
     */
    public function onRegistered($event)
    {
        \Log::info('User Registered: '.$event->user->full_name);
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info('User Confirmed: '.$event->user->full_name);
    }

    /**
     * @param $event
     */
    public function onLoggedOut($event)
    {
        \Log::info('User Logged Out: '.$event->user->full_name);
    }

    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        $ip_address = request()->getClientIp();

        // Update the logging in users time & IP
        $event->user->fill([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $ip_address,
        ]);

        // Update the timezone via IP address
        $geoip = geoip($ip_address);

        if ($event->user->timezone !== $geoip['timezone']) {
            // Update the users timezone
            $event->user->fill([
                'timezone' => $geoip['timezone'],
            ]);
        }

        $event->user->save();


        \Log::info('User Logged In: '.$event->user->full_name);
    }

    /**
     * @param $event
     */
    public function onRefreshed($event)
    {
        \Log::info('User Token Refreshed: '.$event->user->full_name);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Api\Auth\UserRegistered::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onRegistered'
        );

        $events->listen(
            \App\Events\Api\Auth\UserConfirmed::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onConfirmed'
        );

        $events->listen(
            \App\Events\Api\Auth\UserLoggedOut::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onLoggedOut'
        );

        $events->listen(
            \App\Events\Api\Auth\UserTokenRefreshed::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onRefreshed'
        );

        $events->listen(
            \App\Events\Api\Auth\UserLoggedIn::class,
            'App\Listeners\Frontend\Auth\UserEventListener@onLoggedIn'
        );
    }
}