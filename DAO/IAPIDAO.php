<?php
namespace DAO;

interface IAPIDAO
{
    function UpdateAllMovies();
    function UpdateAllGenres();
    function RetrieveRuntime($id);
}
?>