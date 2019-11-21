DELIMITER //
CREATE PROCEDURE SPGetEntriesListByFunctionId(IN functionId INT)
BEGIN
	SELECT * FROM Entries AS e WHERE e.function_id = functionId; 
END//
DELIMITER ;