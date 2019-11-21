<?php
    namespace Helpers;

    use DAO\PriceDAO as PriceDAO;

    class PriceHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new PriceDAO();
        }

        public function GetPriceById($id)
        {
            return $this->repo->GetById($id);
        }
    }
?>