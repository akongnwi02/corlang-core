<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/31/20
 * Time: 9:03 AM
 */

namespace App\Events\Backend\Services\Commission;


use Illuminate\Queue\SerializesModels;

class CommissionCreated
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $commission;
    
    /**
     * @param $commission
     */
    public function __construct($commission)
    {
        $this->commission = $commission;
    }
}
