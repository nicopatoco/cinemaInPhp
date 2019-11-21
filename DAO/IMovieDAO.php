<?php
    namespace DAO;
    
    use Models\Movie as Movie;

    interface IMovieDAO
    {
        function Insert(Movie $movie);
        function GetAll();
        function GetById($id);
    }
?>