<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:13 PM
 */

namespace App\Events\Backend\Companies\Company;

use Illuminate\Queue\SerializesModels;

/**
 * Class CompanyDeactivated
 * @package App\Events\Backend\Company\Company
 */
class CompanyDeactivated
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $company;
    
    /**
     * @param $company
     */
    public function __construct($company)
    {
        $this->company = $company;
    }
}
