<?php
    namespace DAO;

    use DAO\IScheduleDAO as IScheduleDAO;
    use DAO\Connection as Connection;
    use Models\Schedule as Schedule;
    use Helpers\RoomHelper as RoomHelper;

    class ScheduleDAO implements IScheduleDAO
    {
        private $connection;
        private $tableName = "Schedules";
        private $roomHelper;

        public function __construct()
        {
            $this->roomHelper = new RoomHelper();
        }

        public function Add(Schedule $schedule)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (room_id, schedule_date) VALUES (:room_id, :schedule_date);";
                
                $room = $schedule->getRoom();

                $parameters["room_id"] = $room->getId();
                $parameters["schedule_date"] = $schedule->getDate();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $scheduleList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $schedule = new Schedule();

                    $schedule->setId($row["schedule_id"]);
                    $schedule->setDate($row["schedule_date"]);
                    $room = $this->roomHelper->GetRoomById($row["room_id"]);
                    $schedule->setRoom($room);

                    array_push($scheduleList, $schedule);
                }

                return $scheduleList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(Schedule $schedule)
        {   
            try
            {
                $id = $schedule->getId();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".schedule_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(Schedule $schedule, $updatedSchedule)
        {
            try
            {
                $id = $schedule->getId();
                $newDate = $updatedSchedule['schedule_date'];
                $query = "UPDATE ". $this->tableName ." SET schedule_date='$newDate'"  . " WHERE room_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($id)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".schedule_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $schedule = NULL;

                foreach ($resultSet as $row)
                {               
                    $schedule = new Schedule();

                    $schedule->setId($row["schedule_id"]);
                    $schedule->setDate($row["schedule_date"]);
                    $schedule->setRoom($this->roomHelper->GetRoomById($row["room_id"]));
                }

                return $schedule;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetScheduleListByRoomId($id)
        {
            try
            {
                $query = "CALL SPGetSchedulesListByRoomId(" . $id . ");";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $scheduleList = array();

                foreach ($resultSet as $row)
                {               
                    $schedule = new Schedule();

                    $schedule->setId($row["schedule_id"]);
                    $schedule->setDate($row["schedule_date"]);
                    $schedule->setRoom($this->roomHelper->GetRoomById($row["room_id"]));

                    array_push($scheduleList, $schedule);
                }

                return $scheduleList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetId($roomId, $date)
        {
            $query = "CALL SPGetScheduleId(" . $roomId . ", ' " . $date . " ' );";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            return $resultSet[0][0];
        }
    }
?>