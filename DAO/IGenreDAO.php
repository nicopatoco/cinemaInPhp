<?php
    namespace DAO;
    
    use Models\Genre as Genre;

    interface IGenreDAO
    {
        function Insert(Genre $genre);
        function GetAll();
        function GetById($id);
    }
?>