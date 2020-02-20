<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/19/20
 * Time: 11:14 PM
 */

namespace App\Http\Requests\Backend\Payout;


use App\Exceptions\GeneralException;
use Illuminate\Foundation\Http\FormRequest;

class PayoutStatusRequest extends FormRequest
{
    /**
     * @return mixed
     * @throws GeneralException
     */
    public function authorize()
    {
        if (request()->payout->status != config('business.payout.status.pending')) {
            throw new GeneralException(__('exceptions.backend.payout.invalid_status'));
        }
        switch (request()->status) {
            case config('business.payout.status.approved'):
                return auth()->user()->can(config('permission.permissions.approve_payouts'));
            case config('business.payout.status.cancelled'):
                return auth()->user()->can(config('permission.permissions.cancel_payouts'));
            case config('business.payout.status.rejected'):
                return auth()->user()->can(config('permission.permissions.reject_payouts'));
            default:
                throw new GeneralException(__('exceptions.backend.payout.invalid_status'));
        }
    }
    
    public function rules()
    {
        return [];
    }

}
