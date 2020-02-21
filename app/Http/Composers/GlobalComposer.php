<?php

namespace App\Http\Composers;

use App\Models\Company\Company;
use App\Models\System\Currency;
use Illuminate\View\View;

/**
 * Class GlobalComposer.
 */
class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('logged_in_user', auth()->user())
            ->with('default_company', Company::where('is_default', true)->first())
            ->with('default_currency', Currency::where('is_default', true)->first());
    }
}
