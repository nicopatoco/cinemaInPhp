<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\EntryDAO as EntryDAO;
    
    class SalesController
    {
        private $cinemaRepo;
        private $roomRepo;
        private $entryRepo;    

        public function __construct()
        {
            $this->cinemaRepo = new CinemaDAO();
            $this->roomRepo = new RoomDAO();
            $this->entryRepo = new EntryDAO();
        }

        public function ShowListView()
        {
            if ($_SESSION) 
            {
                if ($_SESSION["loggedUser"]->getTypeId() == 1) 
                {
                    $cinemaList = $this->cinemaRepo->GetAll();
                    
                    require_once(VIEWS_PATH."cinema-sales-list.php");
                } 
            }
        }

        public function SalesForCinema()
        {
            if ($_SESSION) 
            {
                if ($_SESSION["loggedUser"]->getTypeId() == 1) 
                {
                    $cinema = $this->cinemaRepo->GetById($_POST['cinema']);

                    $entryList = $this->entryRepo->GetAll();

                    $cinemaEntries = array();
                    foreach($entryList as $key =>$entry)
                    {
                        if($entry->getCinema()->getId() == $cinema->getId())
                        {
                            array_push($cinemaEntries,$entry);
                        }
                    }

                    $sales=0;
                    $discount=0;
                    $total=0;
                    foreach($cinemaEntries as $key =>$entry)
                    {
                        $sales +=$entry->getPrice()->getAmount();
                        $discount +=$entry->getDiscount();
                        $total +=$entry->getTotal();
                    }
                    
                    require_once(VIEWS_PATH."cinema-sales.php");
                } 
            }
        }

        
    }
?>