<?php
    namespace DAO;

    use DAO\IMovieFunctionDAO as IMovieFunctionDAO;
    use Models\MovieFunction as MovieFunction;
    use DAO\Connection as Connection;
    use Helpers\MovieHelper as MovieHelper;
    use Helpers\PriceHelper as PriceHelper;
    use Helpers\ScheduleHelper as ScheduleHelper;

    class MovieFunctionDAO implements IMovieFunctionDAO
    {
        private $connection;
        private $tableName = "Functions";
        private $movieHelper;
        private $scheduleHelper;

        public function __construct()
        {
            $this->movieHelper = new MovieHelper();
            $this->scheduleHelper = new ScheduleHelper();
            $this->priceHelper = new PriceHelper();
        }

        public function Add(MovieFunction $movieFunction)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (movie_id, schedule_id, price_id) VALUES (:movie_id, :schedule_id, :price_id);";

                $parameters["movie_id"] = $movieFunction->getMovie()->getId();
                $parameters["schedule_id"] = $movieFunction->getSchedule()->getId();
                $parameters["price_id"] = $movieFunction->getPrice()->getId();

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
                $movieFunctionList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {
                    $movie = $this->movieHelper->GetMovieById($row["movie_id"]);
                    $schedule = $this->scheduleHelper->GetScheduleById($row["schedule_id"]);
                    $price = $this->priceHelper->GetPriceById($row["price_id"]);

                    $movieFunction = new MovieFunction();

                    $movieFunction->setId($row["function_id"]);
                    $movieFunction->setMovie($movie);
                    $movieFunction->setSchedule($schedule);
                    $movieFunction->setRoom($schedule->getRoom());
                    $movieFunction->setPrice($price);

                    array_push($movieFunctionList, $movieFunction);
                }

                return $movieFunctionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Delete(MovieFunction $movieFunction)
        {
            try
            {
                $id = $movieFunction->getId();
                $schedule = $movieFunction->getSchedule();
                $query = "DELETE FROM ". $this->tableName . " WHERE ". $this->tableName . ".function_id ='$id'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                $this->scheduleHelper->DeleteSchedule($schedule);
            }
            catch(Exception $ex)
            {
               throw $ex;
            }
        }

        public function Update(MovieFunction $movieFunction, $updatedMovieFunction)
        {
            try
            {
                $id = $movieFunction->getId();
                $newMovie = $updatedMovieFunction['movie_id'];
                $newSchedule = $updatedMovieFunction['schedule_id'];
                $newPrice = $updatedMovieFunction['price_id'];
                $query = "UPDATE ". $this->tableName ." SET movie_id='$newMovie', schedule_id='$newSchedule, price_id='$newPrice'"  . " WHERE function_id ='$id'";
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
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".function_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $movieFunction = NULL;

                foreach ($resultSet as $row)
                {
                    $movie = $this->movieHelper->GetMovieById($row["movie_id"]);
                    $schedule = $this->scheduleHelper->GetScheduleById($row["schedule_id"]);

                    $movieFunction = new MovieFunction();

                    $movieFunction->setId($row["function_id"]);
                    $movieFunction->setMovie($movie);
                    $movieFunction->setSchedule($schedule);
                    $movieFunction->setRoom($schedule->getRoom());
                }

                return $movieFunction;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetFunctionsListByRoomId($id)
        {
            try
            {
                $query = "CALL SPGetFunctionsListByRoomId(" . $id . ");";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $movieFunctionList = array();

                foreach ($resultSet as $row)
                {
                    $movie = $this->movieHelper->GetMovieById($row["movie_id"]);
                    $schedule = $this->scheduleHelper->GetScheduleById($row["schedule_id"]);
                    $price = $this->priceHelper->GetPriceById($row["price_id"]);

                    $movieFunction = new MovieFunction();

                    $movieFunction->setId($row["function_id"]);
                    $movieFunction->setMovie($movie);
                    $movieFunction->setSchedule($schedule);
                    $movieFunction->setPrice($price);
                    $movieFunction->setRoom($schedule->getRoom());

                    array_push($movieFunctionList, $movieFunction);
                }

                return $movieFunctionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetFunctionByScheduleId($id)
        {
            $query = "CALL SPGetFunctionByScheduleId(" . $id . ");";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            $movieFunction = NULL;

            foreach ($resultSet as $row)
            {
                $movie = $this->movieHelper->GetMovieById($row["movie_id"]);
                $schedule = $this->scheduleHelper->GetScheduleById($row["schedule_id"]);
                $price = $this->priceHelper->GetPriceById($row["price_id"]);

                $movieFunction = new MovieFunction();

                $movieFunction->setId($row["function_id"]);
                $movieFunction->setMovie($movie);
                $movieFunction->setSchedule($schedule);
                $movieFunction->setPrice($price);
                $movieFunction->setRoom($schedule->getRoom());
            }

            return $movieFunction;
        }
    }
?>
