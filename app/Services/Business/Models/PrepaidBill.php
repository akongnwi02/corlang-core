<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/17/20
 * Time: 1:23 PM
 */

namespace App\Services\Business\Models;

class PrepaidBill implements ModelInterface
{
    
    public $transaction_id;
    public $meter_code;
    public $service_code;
    public $currency_code;
    public $items;
    public $address;
    public $name;
    public $phone;
    public $email;
    public $city;
    public $state;
    public $price;
    public $amount;
    public $energy;
    public $customer_fee;
    
    public function getMeterCode()
    {
        return $this->meter_code;
    }
    
    public function setMeterCode($meter_code)
    {
        $this->meter_code = $meter_code;
        return $this;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function getEnergy()
    {
        return $this->energy;
    }
    
    public function setEnergy($energy)
    {
        $this->energy = $energy;
        return $this;
    }
    
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }
    
    public function getTransactionId()
    {
        return $this->transaction_id;
    }
    
    public function setServiceCode($service_code)
    {
        $this->service_code = $service_code;
        return $this;
    }
    
    public function getServiceCode()
    {
        return $this->service_code;
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
        $this->meter_code = $destination;
        return $this;
    }
    
    public function getDestination()
    {
        return $this->meter_code;
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
}
