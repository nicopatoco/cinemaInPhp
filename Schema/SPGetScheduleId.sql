USE MovieDB;

DELIMITER //
CREATE PROCEDURE SPGetScheduleId(IN roomId INT, IN scheduleDate DATETIME)
BEGIN
	SELECT s.schedule_id
	FROM Schedules as s
	WHERE s.room_id = roomId AND s.schedule_date = scheduleDate;
END //
DELIMITER ;