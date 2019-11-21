<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use Models\Room as Room;

    class RoomController
    {
        private $cinemaRepo;
        private $repo;
        private $cinemaId;
        private $functionRepo;

        public function __construct()
        {
            $this->repo = new RoomDAO();
            $this->cinemaRepo = new CinemaDAO();
            $this->functionRepo = new MovieFunctionDAO();
        }

        public function ShowAddView()
        {
            if($_POST)
            {
                if(isset($_POST["rooms"]))
                {
                    $this->cinemaId = $_POST["rooms"];
                    require_once(VIEWS_PATH."room-add.php");
                }
            }
        }

        private function isAvailableName($roomList,$name) 
        {
            foreach($roomList as $room)
            {
                if($room ->getName() == $name)
                {
                    return false;
                }
            }
            return true;
        }

        public function Add()
        {
            if($_POST)
            {
                $this->cinemaId = $_POST["cinemaId"];
                $cinema = $this->cinemaRepo->GetById($this->cinemaId);
                $roomList = $this->repo->GetRoomsByCinemaId($_POST["cinemaId"]);

                if($this->isAvailableName($cinema->getRoomsList(),$_POST["name"]))
                {
                    $room = new Room();
                    $room->setName($_POST["name"]);
                    $room->setCapacity($_POST["capacity"]);
                    $room->setCinema($cinema);

                    $this->repo->add($room);
                    $roomList = $this->repo->GetRoomsByCinemaId($_POST["cinemaId"]);
                }
                else
                {
                    echo "<script> alert('Sala no dispinible'); </script>";
                }
                
                require_once(VIEWS_PATH."room-custom.php");
            }
        }

        public function Select()
        {   
            if($_POST)
            {
                if(isset($_POST["function"]))
                {
                    $id = $_POST["function"];
                    $room = $this->repo->GetById($id);
                    $functionList = $this->functionRepo->GetFunctionsListByRoomId($room->getId());
                    
                    require_once(VIEWS_PATH."function-custom.php");
                }
                else if(isset($_POST["delete"]))
                {
                    $room = $this->repo->GetById($_POST["delete"]);
                    $cinema = $room->getCinema();
                    $roomList = $this->repo->GetRoomsByCinemaId($cinema->getId());
                    $functionList = $this->functionRepo->GetFunctionsListByRoomId($room->getId());

                    if(empty($functionList))
                    {
                        $this->repo->Delete($room);
                        $roomList = $this->repo->GetRoomsByCinemaId($cinema->getId());
                    }
                    else
                    {
                        echo "<script> alert('Para borrar la sala, deberá borrar las funciones.'); </script>";
                    }

                    require_once(VIEWS_PATH."room-custom.php");
                }
                else if(isset($_POST["edit"]))
                {
                    $id = $_POST["edit"];
                    $room = $this->repo->GetById($id);
                    require_once(VIEWS_PATH."room-update.php");
                }
            }
        }

        public function Update()
        {   
            if($_POST)
            {
                $updatedRoom = $_POST;

                $room = $this->repo->GetById($updatedRoom["room_id"]);
                $cinema = $room->getCinema();
                $roomList = $cinema->getRoomsList();

                if($this->isAvailableName($cinema->getRoomsList(),$_POST["room_name"]) || $_POST["room_name"] == $room->getName())
                {
                    if($room->getCapacity() != $_POST['capacity'])
                    {
                        $functionList = $this->functionRepo->GetFunctionsListByRoomId($room->getId());
                        if(empty($functionList))
                        {
                            $this->repo->Update($room, $updatedRoom);
                            $room = $this->repo->GetById($_POST["room_id"]);
                            $cinema = $room->getCinema();
                            $roomList = $cinema->getRoomsList();
                        }
                        else
                        {
                            echo "<script> alert('Para editar la capacidad, deberá borrar las funciones asociadas'); </script>";
                        }
                    }
                    else
                    {
                        $this->repo->Update($room, $updatedRoom);
                        $room = $this->repo->GetById($_POST["room_id"]);
                        $cinema = $room->getCinema();
                        $roomList = $cinema->getRoomsList();
                    }                 
                }
                else
                {
                    echo "<script> alert('Nombre no dispinible'); </script>";
                }
            
                require_once(VIEWS_PATH."room-custom.php");
            }
        }
    }

?>