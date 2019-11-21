<?php
namespace Models;

use Models\Schedule as Schedule;
use Models\Cinema as Cinema;
use Models\MovieFunction as MovieFunction;

class Room
{
    private $id;
    private $name;
    private $capacity;
    private $scheduleList = array();
    private $functionsList = array();
    private $cinema;

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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of capacity
     */ 
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set the value of capacity
     *
     * @return  self
     */ 
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get the schedule
     */ 
    public function getSchedule()
    {
        return $this->scheduleList;
    }

    /**
     * Add a Schedule to ScheduleList
     *
     * @return  self
     */ 
    public function addScheduleToList(Schedule $schedule)
    {
        array_push($this->scheduleList, $schedule);

        return $this;
    }

    /**
     * Get list of functions
     */ 
    public function getFunctionsList()
    {
        return $this->functionsList;
    }

    /**
     * Add MovieFunction to list
     *
     * @return  self
     */ 
    public function addFunctionToList(MovieFunction $movieFunction)
    {
        array_push($this->functionsList, $movieFunction);

        return $this;
    }

    /**
     * Get the value of cinema
     */ 
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * Set the value of cinema
     *
     * @return  self
     */ 
    public function setCinema(Cinema $cinema)
    {
        $this->cinema = $cinema;

        return $this;
    }
}
?>