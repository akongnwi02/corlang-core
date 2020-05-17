<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/6/20
 * Time: 12:01 AM
 */

namespace App\Services\Business\Models;


class ReceiveMoney implements ModelInterface
{
    
    public $transaction_id;
    public $source_account;
    public $service_code;
    public $currency_code;
    public $items;
    public $address;
    public $name;
    public $phone;
    public $email;
    public $city;
    public $state;
    public $amount;
    public $customer_fee;
    
    public function setServiceCode($code)
    {
       $this->service_code = $code;
       return $this;
    }
    
    public function getServiceCode()
    {
        return $this->service_code;
    }
    
    public function setTransactionId($uuid)
    {
        $this->transaction_id = $uuid;
        return $this;
    }
    
    public function getTransactionId()
    {
        return $this->transaction_id;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setCurrencyCode($code)
    {
        $this->currency_code = $code;
        return $this;
    }
    
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }
    
    public function setDestination($destination)
    {
        $this->source_account = $destination;
        return $this;
    }
    
    public function getDestination()
    {
        return $this->source_account;
    }
    
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }
    
    public function getItems()
    {
        return $this->items;
    }
    
    public function setCustomerFee($fee)
    {
        $this->customer_fee = $fee;
        return $this;
    }
    
    public function getCustomerFee()
    {
        return $this->customer_fee;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }
}
