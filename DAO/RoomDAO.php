<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use Models\Room as Room;
    use DAO\Connection as Connection;
    use Helpers\CinemaHelper as CinemaHelper;

    class RoomDAO implements IRoomDAO
    {
        private $connection;
        private $tableName = "Rooms";

        public function Add(Room $room)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (room_name, capacity, cinema_id) VALUES (:room_name, :capacity, :cinema_id);";
                
                $cinema = $room->getCinema();

                $parameters["room_name"] = $room->getName();
                $parameters["capacity"] = $room->getCapacity();
                $parameters["cinema_id"] = $cinema->getId();

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
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {   
                    $cinema = $this->cinemaRepo->GetById($row["cinema_id"]);
                    
                    $room = new Room();

                    $room->setId($row["room_id"]);
                    $room->setName($row["room_name"]);
                    $room->setCapacity($row["capacity"]);
                    $room->setCinema($cinema);

                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(Room $room)
        {   
            try
            {
                $id = $room->getId();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".room_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(Room $room, $updatedRoom)
        {
            try
            {
                $id = $room->getId();
                $newName = $updatedRoom['room_name'];
                $newCapacity = $updatedRoom['capacity'];
                $query = "UPDATE ". $this->tableName ." SET room_name='$newName', capacity='$newCapacity'"  . " WHERE room_id ='$id'";
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
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".room_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $room = NULL;

                foreach ($resultSet as $row)
                {   
                    $cinemaHelper = new CinemaHelper();            
                    $cinema = $cinemaHelper->GetCinemaById($row["cinema_id"]);

                    $room = new Room();

                    $room->setId($row["room_id"]);
                    $room->setName($row["room_name"]);
                    $room->setCapacity($row["capacity"]);
                    $room->setCinema($cinema);
                }

                return $room;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetRoomsByCinemaId($id)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".cinema_id =".$id;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $roomList = array();

                foreach ($resultSet as $row)
                {            
                    $room = new Room();
                    $room->setId($row["room_id"]);
                    $room->setName($row["room_name"]);
                    $room->setCapacity($row["capacity"]);

                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>