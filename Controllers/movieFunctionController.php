<?php
    namespace Controllers;

    use DAO\MovieFunctionDAO as MovieFunctionDAO;
    use DAO\ScheduleDAO as ScheduleDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\PriceDAO as PriceDAO;
    use DAO\EntryDAO as EntryDAO;
    use Helpers\ScheduleHelper as ScheduleHelper;
    use Models\MovieFunction as MovieFunction;

    class MovieFunctionController
    {
        private $scheduleHelper;
        private $scheduleRepo;
        private $movieRepo;
        private $cinemaRepo;
        private $roomRepo;
        private $priceRepo;
        private $entryRepo;
        private $repo;

        public function __construct()
        {
            $this->repo = new MovieFunctionDAO();
            $this->scheduleRepo = new ScheduleDAO();
            $this->cinemaRepo = new CinemaDAO();
            $this->roomRepo = new RoomDAO();
            $this->movieRepo = new MovieDAO();
            $this->scheduleHelper = new ScheduleHelper();
            $this->priceRepo = new PriceDAO();
            $this->entryRepo = new EntryDAO();
        }

        public function ShowAddView()
        {
            if($_POST)
            {
                if(isset($_POST["room"]))
                {
                    $room = $this->roomRepo->GetById($_POST["room"]);

                    $movieList = $this->movieRepo->GetAll();
                    $priceList = $this->priceRepo->GetAll();

                    require_once(VIEWS_PATH."function-add.php");
                }
            }
        }

        private function isAvailableDate($date, $time,$roomId) {
            $scheduleList = $this->scheduleRepo->GetAll();
            
            $repoDate = array();
            $repoTime = array();
            foreach($scheduleList as $key => $value)
            {
                if($value->getRoom()->getId() == $roomId)
                {
                    $restDate = substr($value->getdate(),0,-9);
                    $restTime = substr($value->getdate(),-8);
                    array_push($repoDate,$restDate);
                    array_push($repoTime,$restTime);
                }
            }

            $i = 0;
            foreach($repoDate as $value)
            {
                if(strcmp($value, $date) == 0)
                {
                    $hRepo = substr($repoTime[$i],0,2);
                    $hTime = substr($time,0,2);

                    $result = $hRepo - $hTime;
                    if( ! (($result >= 3) || ($result <= -3)))
                    {
                        return false;
                    }
                }
                $i++;
            }
            
            return true;
        }

        public function Add()
        {
           if($_POST)
            {   
                $date = ($_POST['date']);
                $time = ($_POST['time']);
                $fullDate = $date."T".$time;
                $movie = $this->movieRepo->GetById($_POST["movie"]);
                $room = $this->roomRepo->GetById($_POST["room"]);

                if($this->isAvailableDate($date,$time,$room->getId()))
                {
                    for($i = 0; $i < $_POST['amountdays']; $i++)
                    {
                        $fullDate = $this->scheduleHelper->GetDate($fullDate, $i);
                        $schedule = $this->scheduleHelper->CreateSchedule($room, $fullDate);
                        $price = $this->priceRepo->GetById($_POST['price']);
    
                        $movieFunction = new MovieFunction();
                        $movieFunction->setMovie($movie);
                        $movieFunction->setSchedule($schedule);
                        $movieFunction->setRoom($room);
                        $movieFunction->setPrice($price);
                        
                        $this->repo->Add($movieFunction);
                    }
                }
                else
                {
                    echo "<script> alert('Horario no dispinible'); </script>";
                }

                $functionList = $this->repo->GetFunctionsListByRoomId($room->getId());
                require_once(VIEWS_PATH."function-custom.php");
            }
        }

        private function GetEntriesListByFunctionId($id)
        {
            $entriesList = $this->entryRepo->GetAll();
            $newEntriesList = array();
            foreach ($entriesList as $key => $value) {
                if($value->getFunction()->getId() == $id)
                {
                    array_push($newEntriesList,$value);
                }
            }
            return $newEntriesList;
        }

        public function Select()
        {   
            if($_POST)
            {
                if(isset($_POST["delete"]))
                {
                    $id = $_POST["delete"];
                    $entryList = $this->GetEntriesListByFunctionId($id);
                    $movieFunction = $this->repo->GetById($id);
                    $room = $movieFunction->getRoom();
                    if(empty($entryList))
                    {
                        $this->repo->Delete($movieFunction);
                    }
                    else
                    {
                        echo "<script> alert('Error, su funcion tiene entradas asociadas.'); </script>";
                    }
                    $functionList = $this->repo->GetFunctionsListByRoomId($room->getId());
                    require_once(VIEWS_PATH."function-custom.php");
                }
            }
        }
    }

?>