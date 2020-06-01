<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/26/20
 * Time: 2:46 PM
 */

namespace App\Repositories\Backend\Services\Category;

use App\Exceptions\GeneralException;
use App\Models\Service\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository
{
    
    public function get()
    {
        return QueryBuilder::for(Category::class)
            ->allowedFilters([
                AllowedFilter::exact('is_active'),
            ])
            ->allowedIncludes('services')
            ->allowedSorts('created_at', 'name')
            ->defaultSort('created_at', 'name');
    }
    
    /**
     * @param $category
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($category, $data)
    {
        $category->fill($data);
    
        if ($category->save()) {
//            event(new CategoryUpdated($method));
            return $category;
        }
    
        throw new GeneralException(__('exceptions.backend.services.category.update_error'));
    }
    
    
    /**
     * @param $category
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($category, $status)
    {
        $category->is_active = $status;
        
        if ($category->save()) {
            
            switch ($status) {
                case 0:
//                    event(new CategoryDeactivated($category));
                    break;
                
                case 1:
//                    event(new CategoryReactivated($category));
                    break;
            }
            
            return $category;
        }
        
        throw new GeneralException(__('exceptions.backend.services.category.mark_error'));
    }
}
