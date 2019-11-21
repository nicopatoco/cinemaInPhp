<?php
    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;
    use DAO\Connection as Connection;

    class MovieDAO implements IMovieDAO
    {
        private $connection;
        private $tableName = "Movies";

        public function Insert(Movie $movie)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (movie_id, movie_name, movie_language, duration, movie_image, overview) VALUES (:movie_id, :movie_name, :movie_language, :duration, :movie_image, :overview);";
                
                $parameters["movie_id"] = $movie->getId();
                $parameters["movie_name"] = $movie->getName();
                $parameters["movie_language"] = $movie->getLanguage();
                $parameters["duration"] = $movie->getDuration();
                $parameters["movie_image"] = $movie->getImage();
                $parameters["overview"] = $movie->getOverview();

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
                $movieList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {   
                    $movie = new Movie
                    (
                        $row["movie_id"],
                        $row["movie_name"],
                        $row["movie_language"],
                        $row["duration"],
                        $row["movie_image"],
                        $row["overview"]
                    );

                    $this->AddGenre($movie);

                    array_push($movieList, $movie);
                }

                return $movieList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function AddGenre($movie)
        {
            $query = "SELECT * FROM Genres as g JOIN MoviesGenres AS mg ON g.genre_id = mg.genre_id WHERE mg.movie_id = " . $movie->getId();

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                $movie->addToGenreList($row["genre_description"]);
            }
        }

        public function GetById($id)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName. " WHERE ". $this->tableName .".movie_id ='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $movie = NULL;

                foreach($resultSet as $row)
                {
                    $movie = new Movie
                    (
                        $row["movie_id"],
                        $row["movie_name"],
                        $row["movie_language"],
                        $row["duration"],
                        $row["movie_image"],
                        $row["overview"]
                    );

                    $this->AddGenre($movie);
                }

                return $movie;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>