<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:23 PM
 */

namespace App\Services\Business\Validators;


use App\Exceptions\GeneralException;

trait ValidatorTrait
{
    /**
     * @param $categoryCode
     * @return PrepaidBillsValidator
     * @throws GeneralException
     */
    public function validator($categoryCode)
    {
        switch ($categoryCode) {
            case config('business.service.category.prepaidbills.code');
                return new PrepaidBillsValidator();
            default:
                throw new GeneralException('Validator for this service does not exist');
        }
    }
}
