<?php
    namespace DAO;
    
    use Models\MovieGenre as MovieGenre;

    interface IMovieGenreDAO
    {
        function Insert(MovieGenre $movieGenre);
    }
?>