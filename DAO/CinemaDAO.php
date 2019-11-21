<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;
    use Helpers\RoomHelper as RoomHelper;

    class CinemaDAO implements ICinemaDAO
    {
        private $connection;
        private $tableName = "Cinemas";
        private $roomHelper;

        public function __construct()
        {
            $this->roomHelper = new RoomHelper();
        }

        public function Add(Cinema $cinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (cinema_name, cinema_location) VALUES (:cinema_name, :cinema_location);";
                
                $parameters["cinema_name"] = $cinema->getName();
                $parameters["cinema_location"] = $cinema->getLocation();

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
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $cinema = new Cinema();

                    $cinema->setId($row["cinema_id"]);
                    $cinema->setName($row["cinema_name"]);
                    $cinema->setLocation($row["cinema_location"]);

                    $roomList = $this->roomHelper->GetRoomsListByCinemaId($row["cinema_id"]);

                    foreach($roomList as $room)
                    {
                        $cinema->AddRoomToList($room);
                    }

                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function Delete(Cinema $cinema)
        {   
            try
            {
                $id = $cinema->getId();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".cinema_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(Cinema $cinema, $updatedCinema)
        {
            try
            {
                $id = $cinema->getId();
                $newName = $updatedCinema['cinema_name'];
                $newLocation = $updatedCinema['cinema_location'];
                $query = "UPDATE ". $this->tableName ." SET cinema_name='$newName', cinema_location='$newLocation'"  . " WHERE cinema_id ='$id'";
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
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".cinema_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $cinema = NULL;

                foreach ($resultSet as $row)
                {               
                    $cinema = new Cinema();

                    $cinema->setId($row["cinema_id"]);
                    $cinema->setName($row["cinema_name"]);
                    $cinema->setLocation($row["cinema_location"]);
                    
                    $roomList = $this->roomHelper->GetRoomsListByCinemaId($row["cinema_id"]);
                    $cinema->setRoomList($roomList);
                }

                return $cinema;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>