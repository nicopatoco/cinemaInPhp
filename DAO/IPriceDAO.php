<?php
namespace DAO;

use Models\Price as Price;

interface IPriceDAO
{
    function Add(Price $price);
    function GetAll();
    function Delete(Price $price);
    function Update(Price $price, $updatedPrice);
    function GetById($id);
}
?>