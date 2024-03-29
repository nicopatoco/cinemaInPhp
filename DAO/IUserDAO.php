<?php
namespace DAO;

use Models\User as User;

interface IUserDAO
{
    function Add(User $user);
    function GetAll();
    function Delete(User $user);
    function GetById($id);
}
?>