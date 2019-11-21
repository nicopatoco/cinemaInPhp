<?php
    namespace Helpers;

    use DAO\ScheduleDAO as ScheduleDAO;
    use Models\Schedule as Schedule;
    use Models\Room as Room;

    class ScheduleHelper
    {
        private $repo;

        public function __construct()
        {
            $this->repo = new ScheduleDAO();
        }
        
        public function CreateSchedule(Room $room, $date)
        {
            $schedule = new Schedule();
            $schedule->setRoom($room);
            $schedule->setDate($date);

            $this->repo->Add($schedule);

            $schedule->setId($this->repo->GetId($room->getId(), $date));

            return $schedule;
        }

        public function GetDate($startingDate, $iterator)
        {
            $newDate = date("Y-m-d H:i:s", strtotime($startingDate . " + "."$iterator". "day"));
            return $newDate;
        }

        public function GetScheduleById($id)
        {
            return $this->repo->GetById($id);
        }

        public function DeleteSchedule(Schedule $schedule)
        {
            $this->repo->Delete($schedule);
        }

        private function containsDate($dateList , $date)
        {
            foreach ($dateList as $value)
            {
                if($value == $date){
                    return true;
                }
            }
            return false;
        }

        public function GetDateList()
        {
            $scheduleList = $this->repo->GetAll();

            $dateList = array();
            foreach($scheduleList as $key => $value)
            {
                $restDate = substr($value->getdate(),0,-9);
                if(!$this->containsDate($dateList,$restDate))
                {
                    array_push($dateList,$restDate);
                }
            }

            return $dateList;
        }

        public function GetFullDateList()
        {
            $scheduleList = $this->repo->GetAll();

            $dateList = array();
            foreach($scheduleList as $key => $value)
            {
                $aux = $value;
                $aux->setDate(substr($value->getdate(),0,-9));
                array_push($dateList,$aux);
            }

            return $dateList;
        }
    }
?>