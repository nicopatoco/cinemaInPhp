<?php
namespace DAO;

use Models\Room as Room;

interface IRoomDAO
{
    function Add(Room $room);
    function GetAll();
    function Delete(Room $room);
    function Update(Room $room, $updatedRoom);
    function GetById($id);
    function GetRoomsByCinemaId($id);
}
?>