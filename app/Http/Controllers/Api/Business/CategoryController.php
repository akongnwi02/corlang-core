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
use App\Repositories\Backend\Services\Category\CategoryRepository;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return $category->with('services');
    }
    
    public function index(CategoryRepository $categoryRepository)
    {
        return response()->json($categoryRepository->getAllCategories()->get());
    }
}
