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
        if (request()->has_items){
            foreach ($value as $item) {
                validator($item, [
                    'name' => ['required', 'string', 'min:3',],
                    'code' => ['required', 'string', 'min:3',],
                    'amount' => ['required', 'numeric', 'min:0'],
                ])->validate();
            }
        }

        return true;
    }
    
    public function message()
    {
        return __('exceptions.backend.services.service.invalid_items');
    }
    
}
