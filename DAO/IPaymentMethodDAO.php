<?php
namespace DAO;

use Models\PaymentMethod as PaymentMethod;

interface IPaymentMethodDAO
{
    function Add(PaymentMethod $paymentMethod);
    function GetAll();
    function Delete(PaymentMethod $paymentMethod);
    function Update(PaymentMethod $paymentMethod, $updatedPaymentMethod);
    function GetById($id);
}
?>