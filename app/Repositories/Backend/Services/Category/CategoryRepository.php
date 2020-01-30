<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/26/20
 * Time: 2:46 PM
 */

namespace App\Repositories\Backend\Services\Category;


use App\Models\Service\Category;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryRepository
{
    
    public function get()
    {
        return QueryBuilder::for(Category::class)
            ->allowedSorts('created_at', 'name')
            ->defaultSort('created_at', 'name');
    }
}
