<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 10:22 PM
 */

namespace App\Events\Backend\Company\Company;


use Illuminate\Queue\SerializesModels;

class CompanyUpdated
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
