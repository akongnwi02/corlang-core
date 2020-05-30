<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/17/20
 * Time: 1:23 PM
 */

namespace App\Services\Business\Models;



class PostpaidBill implements ModelInterface
{
    public $transaction_id;
    public $bill_number;
    public $bill_due_date;
    public $bill_is_late;
    public $bill_is_paid;
    public $service_code;
    public $contract_number;
    public $address;
    public $name;
    public $phone;
    public $email;
    public $city;
    public $state;
    public $amount;
    public $currency_code;
    public $items;
    public $customer_fee;
    
    public function getBillNumber()
    {
        return $this->bill_number;
    }
    
    public function setBillNumber($bill_number)
    {
        $this->bill_number = $bill_number;
        return $this;
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
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
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
    
    public function getBillDueDate()
    {
        return $this->bill_due_date;
    }
    
    public function setBillDueDate($bill_due_date)
    {
        $this->bill_due_date = $bill_due_date;
        return $this;
    }
    
    public function getBillIsLate()
    {
        return $this->bill_is_late;
    }
    
    public function setBillIsLate($bill_is_late)
    {
        $this->bill_is_late = $bill_is_late;
        return $this;
    }
    
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }
    
    public function setCurrencyCode($currency)
    {
        $this->currency_code = $currency;
        return $this;
    }
    
    public function getContractNumber()
    {
        return $this->contract_number;
    }
    
    public function setContractNumber($contract_number)
    {
        $this->contract_number = $contract_number;
        return $this;
    }
    
    public function getBillIsPaid()
    {
        return $this->bill_is_paid;
    }
    
    public function setBillIsPaid($bill_is_paid)
    {
        $this->bill_is_paid = $bill_is_paid;
        return $this;
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
    
    public function setDestination($destination)
    {
        $this->bill_number = $destination;
        return $this;
    }
    
    public function getDestination()
    {
        return $this->bill_number;
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
