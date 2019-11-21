USE MovieDB;

DELIMITER //
CREATE PROCEDURE SPGetScheduleListByRoomId(IN scheduleId INT)
BEGIN
	SELECT *
    FROM Schedules
    WHERE Schedules.room_id = scheduleId;
END //
DELIMITER ;