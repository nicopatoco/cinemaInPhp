<?php
    namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use DAO\ScheduleDAO as ScheduleDAO;
    use Models\Schedule as Schedule;

    class ScheduleController
    {

        private $roomRepo;
        private $room;
        private $repo;

        public function __construct()
        {
            $this->repo = new ScheduleDAO();
            $this->roomRepo = new RoomDAO();
        }

        public function ShowAddView()
        {
            if($_POST)
            {
                if(isset($_POST["add"]))
                {
                    $this->room = $this->roomRepo->GetById($_POST["add"]);

                    require_once(VIEWS_PATH."schedule-add.php");
                }
            }
        }

        public function Add()
        {
           if($_POST)
            {
                $this->room = $this->roomRepo->GetById($_POST['newschedule']);

                $schedule = new Schedule();
                $schedule->setRoom($this->room);
                $schedule->setDate($_POST['date']);
                $schedule->setIsUsed(0);

                $this->repo->Add($schedule);
                //I declare a room because, my previous form needs that variable.
                $room = $this->room;
                require_once(VIEWS_PATH."schedule.php");
            }
        }

        public function Select()
        {   
            if($_POST)
            {
                if(isset($_POST["delete"]))
                {
                    $id = $_POST["delete"];
                    $schedule = $this->repo->GetById($id);
                    $room = $schedule->getRoom();
                    $this->repo->Delete($schedule);
                    
                    require_once(VIEWS_PATH."schedule.php");
                }
            }
        }
    }

?>