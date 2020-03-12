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
            // get default currency
            'currency' => $currencyRepository->get()->where('is_default', true)->get()[0],
            // get default country
            'country' => $countryRepository->get()->where('is_default', true)->get()[0],
            // get all payment methods
            'methods' => $paymentMethodRepository->getPaymentMethods()
                // when the user does not belong to a company
                ->when(! auth()->user()->company_id, function ($query) {
                    // don't return the default payment method
                    $query->where('is_default', false);
                })
                // with related service
                ->with(['service' => function ($query) {
                    // only active services
                    $query->where('is_active', true);
                }])->get(),
            // get all categories
            'categories' => $categoryRepository->get()
                // only active categories
                ->where('is_active', true)
                // get related services
                ->with(['services' => function ($query) {
                    // only active services
                    $query->where('is_active', true)
                        // when the user belongs to a company
                        ->when(auth()->user()->company_id, function ($query) {
                        // get only the company services
                            $query->whereHas('companies', function ($query) {
                                // which the company has access to
                                $query->where('companies.uuid', auth()->user()->company_id)
                                    // which are active
                                    ->where('company_service.is_active', true);
                        });
                    });
                },
//               Add items to the list of services
//               Like airtime plans
//              'items' => function () {}
                ])->get(),
        ]);
    }
}
