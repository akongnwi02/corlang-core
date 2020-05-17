<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/22/20
 * Time: 12:28 AM
 */

namespace App\Services\Business\Models;


interface ModelInterface
{
    public function setServiceCode($code);
    
    public function getServiceCode();
    
    public function setTransactionId($uuid);
    
    public function getTransactionId();
    
    public function setAmount($amount);
    
    public function getAmount();
    
    public function setPhone($phone);
    
    public function getPhone();
    
    public function setCurrencyCode($code);
    
    public function getCurrencyCode();
   
    public function setDestination($destination);
    
    public function getDestination();
    
    public function setItems($items);
    
    public function getItems();
    
    public function setCustomerFee($fee);
    
    public function getCustomerFee();
}
