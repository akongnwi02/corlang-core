<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 2:18 PM
 */

namespace App\Events\Backend\Services\Service;


use Illuminate\Queue\SerializesModels;

class ServiceCreated
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $service;
    
    /**
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }
}
