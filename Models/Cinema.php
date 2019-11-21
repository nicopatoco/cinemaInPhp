<?php
namespace Models;

use Models\Room as Room;

class Cinema
{
    private $id;
    private $name;
    private $location;
    private $roomsList = array();

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
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set the value of rooom
     */ 
    public function setRoomList($roomList)
    {
        $this->roomsList = $roomList;
    }

    /**
     * Get list of Rooms
     */ 
    public function getRoomsList()
    {
        return $this->roomsList;
    }

    /**
     * Add room to list
     */ 
    public function AddRoomToList(Room $room)
    {
        $this->roomsList = $room;
    }
}
?>