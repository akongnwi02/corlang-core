<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/14/20
 * Time: 6:53 PM
 */

namespace App\Rules\Account;

use App\Repositories\Backend\Movement\MovementRepository;
use Illuminate\Contracts\Validation\Rule;

class SufficientBalanceRule implements Rule
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
        if (request()->direction == 'IN') {
            $source = auth()->user()->company->account;
        } else {
            $source = request()->account;
        }
    
        $balance = (new MovementRepository())->getAccountBalance($source);
        
        return $balance >= request()->amount;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('exceptions.backend.account.insufficient_balance');
    }
}
