<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/1/20
 * Time: 2:48 PM
 */

namespace App\Http\Composers\Frontend;


use App\Repositories\Backend\Company\Company\CompanyRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use Illuminate\View\View;

class TopupAccountComposer
{
    public $paymentMethodRepository;
    public $companyRepository;
    
    public function __construct(PaymentMethodRepository $paymentMethodRepository, CompanyRepository $companyRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->companyRepository = $companyRepository;
    }
    
    public function compose(View $view)
    {
        $view->with('topup_methods', auth()->user()->company_id ? $this->companyRepository->getAvailablePaymentMethods(auth()->user()->company)->get() : $this->paymentMethodRepository->getPaymentMethods()->where('is_default', false)->get());
    }
}
