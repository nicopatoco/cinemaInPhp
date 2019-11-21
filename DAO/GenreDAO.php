<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;
    use DAO\Connection as Connection;

    class GenreDAO implements IGenreDAO
    {
        private $connection;
        private $tableName = "Genres";

        public function Insert(Genre $genre)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (genre_id, genre_description) VALUES (:genre_id, :genre_description);";
                
                $parameters["genre_id"] = $genre->getId();
                $parameters["genre_description"] = $genre->getDescription();

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
                $genreList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $genre = new Genre();
                    
                    $genre->setId($row["genre_id"]);
                    $genre->setDescription($row["genre_description"]);

                    array_push($genreList, $genre);
                }

                return $genreList;
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
                $query = "SELECT * FROM " . $this->tableName . " WHERE " . $this->tableName . ".genre_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $genre = NULL;

                foreach ($resultSet as $row)
                {   
                    $genre = new Genre();
                    
                    $genre->setId($row["genre_id"]);
                    $genre->setDescription($row["genre_description"]);
                }

                return $genre;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>