<?php
    namespace Helpers;

    use DAO\EntryDAO as EntryDAO;

    class EntryHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new EntryDAO();
        }
        
        public function GetEntriesListByFunctionId($id)
        {
            return $this->repo->GetEntriesListByFunctionId($id);
        }
    }
?>