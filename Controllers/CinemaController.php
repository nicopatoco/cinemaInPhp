<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaController
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new CinemaDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinema-add.php");
        }

        public function ShowListView()
        {
            $cinemaList = $this->repo->GetAll();

            if ($_SESSION) 
            {
                if ($_SESSION["loggedUser"]->getTypeId() == 1) 
                {
                    $cinemaList = $this->repo->GetAll();
                    require_once(VIEWS_PATH."admin-cinema-list.php");
                } 
            }
        }

        private function isAvailableName($name) 
        {
            $cinemaList = $this->repo->getAll();
            foreach($cinemaList as $cinema)
            {
                if($cinema ->getName() == $name)
                {
                    return false;
                }
            }
            return true;
        }

        public function Add($name, $location)
        {
            if($this->isAvailableName($name)){
                $cinema = new Cinema();
                $cinema->setName($name);
                $cinema->setLocation($location);

                $this->repo->Add($cinema);
            }
            else
            {
                echo "<script> alert('Cine no dispinible'); </script>";
            }

            $this->ShowListView();
        }

        public function Delete($id)
        {
            $this->repo->Delete($id);

            $this->ShowListView();
        }

        public function Select()
        {   
            if($_POST)
            {
                if(isset($_POST["edit"]))
                {
                    $id = $_POST["edit"];
                    $cinema = $this->repo->GetById($id);
                    require_once(VIEWS_PATH."cinema-update.php");
                }
                else if(isset($_POST["delete"]))
                {
                    $id = $_POST["delete"];
                    $cinema = $this->repo->GetById($id);
                    if(empty($cinema->getRoomsList()))
                    {
                        $this->repo->Delete($cinema);
                    }
                    else
                    {
                        echo "<script> alert('Para borrar este cine, deberá borrar las salas.'); </script>";
                    }
                    $this->ShowListView();
                }
                else if(isset($_POST["rooms"]))
                {
                    $cinema = $this->repo->GetById($_POST["rooms"]);
                    $roomList = $cinema->getRoomsList();

                    require_once(VIEWS_PATH."room-custom.php");
                }
            }
        }

        public function Update()
        {   
            if($_POST)
            {
                $updatedCinema = $_POST;
                $cinema = $this->repo->GetById($updatedCinema["cinema_id"]);
                if($this->isAvailableName($cinema->getName()) || $cinema->getName() == $_POST['cinema_name']){
                    $this->repo->Update($cinema, $updatedCinema);
                }
                else
                {
                    echo "<script> alert('El cine ya existe'); </script>";
                }
                $this->ShowListView();
            }
        }
    }
