<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 8:32 PM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Services\Category\CategoryRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Repositories\Backend\System\CountryRepository;
use App\Repositories\Backend\System\CurrencyRepository;

class ConfigurationController extends Controller
{
    public function index(
        CurrencyRepository $currencyRepository,
        CategoryRepository $categoryRepository,
        CountryRepository $countryRepository,
        PaymentMethodRepository $paymentMethodRepository
    ){
        return response()->json([
            'currency' => $currencyRepository->get()->where('is_default', true)->get(),
            'country' => $countryRepository->get()->where('is_default', true)->get(),
            'methods' => $paymentMethodRepository->getPaymentMethods()->with(['service' => function ($query) {
                $query->where('is_active', true);
            }])->get(),
            'categories' => $categoryRepository->get()
                ->where('is_active', true)->with(['services' => function ($query) {
                    $query->where('is_active', true);
                }])->get(),
        ]);
    }
}
