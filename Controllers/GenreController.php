<?php
    namespace Controllers;

    use DAO\GenreDAO as GenreDAO;

    class GenreController
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new GenreDAO();
        }

        private function ShowListView()
        {
            $genreList = $this->repo->GetAll();

            require_once(VIEWS_PATH."genre-list.php");
        }

        public function Update(){
            $this->repo->UpdateAll();

            $this->ShowListView();
        }
    }
?>