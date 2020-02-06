<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 2:20 PM
 */

namespace App\Events\Backend\Companies\Service;

use Illuminate\Queue\SerializesModels;

class ServiceDeactivated
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $service;
    
    public $company;
    
    /**
     * @param $company
     * @param $service
     */
    public function __construct($company, $service)
    {
        $this->service = $service;
        
        $this->company = $company;
    }
}
