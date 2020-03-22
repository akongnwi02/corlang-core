<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:23 PM
 */

namespace App\Services\Business\Validators;

use App\Exceptions\GeneralException;
use App\Services\Clients\Category\PrepaidBillClient;

trait CategoryTrait
{
    /**
     * @param $category
     * @return PrepaidBillClient
     * @throws GeneralException
     */
    public function category($category)
    {
        switch ($category->code) {
            case config('business.service.category.prepaidbills.code');
                return new PrepaidBillClient($category);
            default:
                throw new GeneralException('Validator for this service does not exist');
        }
    }
}
