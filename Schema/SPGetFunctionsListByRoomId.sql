USE MovieDB;

DELIMITER //
CREATE PROCEDURE SPGetFunctionsListByRoomId(IN roomId INT)
BEGIN
	SELECT *
	FROM Functions as f
	JOIN Schedules as s ON f.schedule_id = s.schedule_id
	JOIN Rooms as r ON r.room_id = s.room_id
	WHERE r.room_id = roomId;
END //
DELIMITER ;