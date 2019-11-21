<?php
namespace Models;

class MovieGenre
{
    private $id;
    private $movieId;
    private $genreId;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of movieId
     */ 
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set the value of movieId
     *
     * @return  self
     */ 
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get the value of genreId
     */ 
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * Set the value of genreId
     *
     * @return  self
     */ 
    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;

        return $this;
    }
}
?>