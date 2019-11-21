<?php
    namespace Helpers;

    use DAO\UserDAO as UserDAO;

    class UserHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new UserDAO();
        }
        
        public function GetUserById($id)
        {
            return $this->repo->GetById($id);
        }
    }
?>