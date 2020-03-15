<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:23 PM
 */

namespace App\Rules\Business;


use App\Models\Service\Item;
use Illuminate\Contracts\Validation\Rule;

class ItemExistRule implements Rule
{
    public function message()
    {
        return 'Invalid or deactivated item provided in items array';
    }
    
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
            if (! Item::where('code', $item)
                ->where('is_active', true)
                ->exists()
            ) {
                \Log::error('invalid or deactivated item', $item);
                return false;
            }
        }
        return true;
    }
}
