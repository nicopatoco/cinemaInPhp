<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;

    class HomeController
    {
        private $cinemaRepo;

        public function __construct()
        {
            $this->cinemaRepo = new CinemaDAO();
        }

        public function Index($message = "")
        {
            if (isset($_SESSION["loggedUser"])) 
	        {
                if ($_SESSION["loggedUser"]->getTypeId() == 1)
                {
                    $cinemaList = $this->cinemaRepo->GetAll();

                    require_once(VIEWS_PATH . "admin-cinema-list.php");        
                }
                else
                {
                    require_once(VIEWS_PATH."index.php");
                }   
            }
            else
            {
                require_once(VIEWS_PATH."index.php");
            }            
        }        
    }
?>