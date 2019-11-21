<?php
    namespace Helpers;

    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use Models\MovieFunction as MovieFunction;

    class MovieFunctionHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new MovieFunctionDAO();
        }
        
        public function IsFull(MovieFunction $function)
        {
            $capacity = (int) $function->getRoom()->getCapacity();
            return $capacity <= sizeof($function->getEntriesList());
        }

        public function GetFunctionById($id)
        {
            return $this->repo->GetById($id);
        }

    }
?>