<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/14/20
 * Time: 1:40 AM
 */

namespace App\Http\Requests\Api\Business;


use Illuminate\Foundation\Http\FormRequest;

class CancelPayoutRequest extends FormRequest
{
    public function authorize()
    {
        return request()->payout->account == auth()->user()->account
            && request()->payout->status == config('business.transaction.status.pending');
    }
    
    public function rules()
    {
        return [];
    }
}
