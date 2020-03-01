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
use App\Repositories\Backend\System\CountryRepository;

class CountryController extends Controller
{
    public function show(Category $category)
    {
        return $category->with('services');
    }
    
    public function index(CountryRepository $countryRepository)
    {
        return response()->json($countryRepository->get()->get());
    }
}
