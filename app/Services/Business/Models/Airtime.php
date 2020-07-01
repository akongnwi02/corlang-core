<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/1/20
 * Time: 12:12 AM
 */

namespace App\Services\Business\Models;


class Airtime implements ModelInterface
{
    public $transaction_id;
    
    public $service_code;
    
    public $currency_code;

    public $address;

    public $phone;

    public $name;
    
    public $amount;
    
    public $items;
    
    public $customer_fee;
    
    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * @param mixed $address
     * @return Airtime
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     * @return Airtime
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * @param mixed $amount
     * @return Airtime
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }
    
    /**
     * @param $int_id
     * @return Airtime
     */
    public function setTransactionId($int_id)
    {
        $this->transaction_id = $int_id;
        return $this;
        
    }
    
    /**
     * @param mixed $service_code
     * @return Airtime
     */
    public function setServiceCode($service_code)
    {
        $this->service_code = $service_code;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getServiceCode()
    {
        return $this->service_code;
    }
    
    /**
     * @param mixed $phone
     * @return Airtime
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    
    /**
     * @return mixed
     */
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
        $this->phone = $destination;
        return $this;
    }
    
    public function getDestination()
    {
        return $this->phone;
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
