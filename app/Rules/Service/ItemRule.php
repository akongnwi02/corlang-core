<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 5:07 PM
 */

namespace App\Rules\Service;


use Illuminate\Contracts\Validation\Rule;

class ItemRule implements Rule
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
        foreach ($value as $item) {
            if (
                array_diff(['name', 'code', 'amount'], array_keys($item))
                // make sure the values are positive
                || $item['amount'] < 0
            ) {
                \Log::error('invalid item format', ['item' => $item]);
                return false;
            }
        }
        return true;
    }
    
    public function message()
    {
        return __('exceptions.backend.services.service.invalid_items');
    }
    
}
