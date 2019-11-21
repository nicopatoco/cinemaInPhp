<?php
    namespace Helpers;

    use DAO\MovieDAO as MovieDAO;

    class MovieHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new MovieDAO();
        }
        
        public function GetMovieById($id)
        {
            return $this->repo->GetById($id);
        }
    }
?>