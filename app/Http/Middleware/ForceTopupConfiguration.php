<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 12/8/20
 * Time: 12:08 AM
 */

namespace App\Http\Middleware;


use Closure;

class ForceTopupConfiguration
{
    public function handle($request, Closure $next)
    {
        if (config('access.users.force_topup_configuration')) {
    
            $user = $request->user();
            
            $configuredTopups = $user->topup_accounts()->whereNotNull('account');
            if (! $configuredTopups->count()) {
                \Log::warning('No top up method has been configured and force top up configuration is set to true');
                return redirect()->route('frontend.user.force-topup');
            }
        }
        return $next($request);
    }
}
