<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 11:49 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Models\Service\Category;
use App\Models\System\Currency;
use App\Repositories\Backend\System\CountryRepository;
use App\Repositories\Backend\System\CurrencyRepository;

class CurrencyController extends Controller
{
    public function show(Currency $currency)
    {
    
    }
    
    public function index(CurrencyRepository $currencyRepository)
    {
        return response()->json($currencyRepository->get()->get());
    }
}
