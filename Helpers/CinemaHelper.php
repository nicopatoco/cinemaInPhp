<?php
    namespace Helpers;

    use DAO\CinemaDAO as CinemaDAO;

    class CinemaHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new CinemaDAO();
        }
        
        public function GetCinemaById($id)
        {
            return $this->repo->GetById($id);
        }
    }
?>