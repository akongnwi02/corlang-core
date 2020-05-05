<?php

namespace App\Providers;

use App\Http\Composers\Backend\DashboardComposer;
use App\Http\Composers\Frontend\TopupAccountComposer;
use Illuminate\Support\Facades\View;
use App\Http\Composers\GlobalComposer;
use Illuminate\Support\ServiceProvider;
use App\Http\Composers\Backend\SidebarComposer;

/**
 * Class ComposerServiceProvider.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Global
         */
        View::composer(
        // This class binds the $logged_in_user variable to every view
            '*',
            GlobalComposer::class
        );

        /*
         * Frontend
         */
        View::composer(
            'frontend.user.account.tabs.topup',
            TopupAccountComposer::class
        );

        /*
         * Backend
         */
        View::composer(
        // This binds items like number of users pending approval when account approval is set to true
            'backend.includes.sidebar',
            SidebarComposer::class
        );
        
        View::composer(
        // This binds items like number of users pending approval when account approval is set to true
            'backend.dashboard',
            DashboardComposer::class
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
