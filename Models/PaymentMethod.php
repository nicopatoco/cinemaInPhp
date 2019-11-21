<?php
namespace Models;

class PaymentMethod
{
    private $id;
    private $paymentName;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of paymentName
     */ 
    public function getPaymentName()
    {
        return $this->paymentName;
    }

    /**
     * Set the value of paymentName
     *
     * @return  self
     */ 
    public function setPaymentName($paymentName)
    {
        $this->paymentName = $paymentName;

        return $this;
    }
}
?>
