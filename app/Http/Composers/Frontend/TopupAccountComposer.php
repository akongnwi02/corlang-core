<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/1/20
 * Time: 2:48 PM
 */

namespace App\Http\Composers\Frontend;


use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use Illuminate\View\View;

class TopupAccountComposer
{
    public $paymentMethodRepository;
    
    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }
    
    public function compose(View $view)
    {
        $view->with('topup_methods', $this->paymentMethodRepository->getPaymentMethods()->where('is_default', false)->get());
    }
}
