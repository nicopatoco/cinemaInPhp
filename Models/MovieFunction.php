<?php
namespace Models;

use Models\Schedule as Schedule;
use Models\Movie as Movie;
use Models\Room as Room;
use Models\Price as Price;

class MovieFunction
{
    private $id;
    private $movie;
    private $schedule;
    private $room;
    private $price;
    private $entriesList = array();

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
     * Get the value of movie
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */ 
    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of schedule
     */ 
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * Set the value of schedule
     *
     * @return  self
     */ 
    public function setSchedule(Schedule $schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get the value of entriesList
     */ 
    public function getEntriesList()
    {
        return $this->entriesList;
    }

    /**
     * Add Entry to entriesList
     *
     * @return  self
     */ 
    public function setEntriesList($entriesList)
    {
        $this->entriesList = $entriesList;

        return $this;
    }

    /**
     * Get the value of room
     */ 
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set the value of room
     *
     * @return  self
     */ 
    public function setRoom(Room $room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(Price $price)
    {
        $this->price = $price;

        return $this;
    }
}
?>