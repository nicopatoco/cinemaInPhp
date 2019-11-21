<?php
namespace DAO;

use Models\MovieFunction as MovieFunction;

interface IMovieFunctionDAO
{
    function Add(MovieFunction $movieFunction);
    function GetAll();
    function Delete(MovieFunction $movieFunction);
    function Update(MovieFunction $movieFunction, $updatedMovieFunction);
    function GetById($id);
    function GetFunctionByScheduleId($id);
}
?>