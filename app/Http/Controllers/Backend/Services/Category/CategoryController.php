<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/31/20
 * Time: 11:42 AM
 */

namespace App\Http\Controllers\Backend\Services\Category;


use App\Http\Requests\Backend\Services\Category\UpdateCategoryRequest;
use App\Http\Requests\Backend\Services\Category\ChangeCategoryStatusRequest;
use App\Models\Service\Category;
use App\Repositories\Backend\Services\Category\CategoryRepository;

class CategoryController
{
    /**
     * @param CategoryRepository $categoryRepository
     * @return mixed
     */
    public function index(CategoryRepository $categoryRepository)
    {
        return view('backend.services.category.index')
            ->withCategories($categoryRepository->get()
                ->paginate());
    }
    
    /**
     * @param Category $category
     * @return mixed
     */
    public function edit(Category $category)
    {
        return view('backend.services.category.edit')
            ->withCategory($category);
    }
    
    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @param CategoryRepository $categoryRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateCategoryRequest $request, Category $category, CategoryRepository $categoryRepository)
    {
        $categoryRepository->update($category, $request->input());
        
        return redirect()->route('admin.services.category.index')
                ->withFlashSuccess(__('alerts.backend.services.category.updated'));
    }
    
    /**
     * @param CategoryRepository $categoryRepository
     * @param ChangeCategoryStatusRequest $request
     * @param Category $category
     * @param $status
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(CategoryRepository $categoryRepository, ChangeCategoryStatusRequest $request, Category $category, $status)
    {
        $categoryRepository->mark($category, $status);
        
        return redirect()->route('admin.services.category.index')
            ->withFlashSuccess(__('alerts.backend.services.category.status_updated'));
    }
}
