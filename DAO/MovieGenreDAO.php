<?php
    namespace DAO;

    use DAO\IMovieGenreDAO as IMovieGenreDAO;
    use DAO\Connection as Connection;
    use Models\MovieGenre as MovieGenre;

    class MovieGenreDAO implements IMovieGenreDAO
    {
        private $tableName = "MoviesGenres";
        private $connection;

        public function Insert(MovieGenre $movieGenre)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (movie_id, genre_id) VALUES (:movie_id, :genre_id);";
                
                $parameters["movie_id"] = $movieGenre->getMovieId();
                $parameters["genre_id"] = $movieGenre->getGenreId();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>