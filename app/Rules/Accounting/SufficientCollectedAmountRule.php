<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/2/20
 * Time: 1:51 AM
 */

namespace App\Rules\Accounting;


use App\Models\Service\Service;
use Illuminate\Contracts\Validation\Rule;

class SufficientCollectedAmountRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return request()->route('service')->getCollectedAmount() >= request()->amount;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('exceptions.backend.accounting.insufficient_collected_amount');
    }
}
