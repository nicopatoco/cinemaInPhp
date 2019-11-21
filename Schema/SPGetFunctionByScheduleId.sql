DELIMITER //
CREATE PROCEDURE SPGetFunctionByScheduleId(IN scheduleId INT)
BEGIN
	SELECT * FROM Functions AS f WHERE f.schedule_id = scheduleId; 
END//
DELIMITER ;