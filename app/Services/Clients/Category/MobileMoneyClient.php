<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/17/20
 * Time: 11:14 PM
 */

namespace App\Services\Clients\Category;


use App\Models\Service\Category;
use App\Services\Clients\CategoryInterface;

class MobileMoneyClient implements CategoryInterface
{
    public $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    public function validate($request)
    {
        // TODO: Implement validate() method.
    }
    
    public function confirm($transaction)
    {
        // TODO: Implement confirm() method.
    }
    
    public function getCategoryClientName(): string
    {
        // TODO: Implement getCategoryClientName() method.
    }
}
