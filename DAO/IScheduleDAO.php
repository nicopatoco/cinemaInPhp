<?php
namespace DAO;

use Models\Schedule as Schedule;

interface IScheduleDAO
{
    function Add(Schedule $schedule);
    function GetAll();
    function Delete(Schedule $schedule);
    function Update(Schedule $schedule, $updatedSchedule);
    function GetById($id);
    function GetScheduleListByRoomId($id);
    function GetId($roomId, $date);
}
?>