<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/13/20
 * Time: 12:18 PM
 */

namespace App\Http\Requests\Api\Business;


use Illuminate\Foundation\Http\FormRequest;

class DeleteTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return request()->transaction->user->uuid == auth()->user()->uuid
            && request()->transaction->status == config('business.transaction.status.created');
    }
    
    public function rules()
    {
        return [];
    }
}
