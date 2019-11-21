USE MovieDB

DELIMITER //
CREATE PROCEDURE SPGetFunctionsByMovieId(IN movieId INT)
BEGIN
	SELECT * 
	FROM Functions as f
	WHERE f.movie_id = movieId;
END//
DELIMITER ;