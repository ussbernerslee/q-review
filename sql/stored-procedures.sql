DROP PROCEDURE IF EXISTS getPointsOnBoard;

-- stored procedure to sum points by profile from ledger
DELIMITER //
CREATE PROCEDURE getPointsOnBoard(IN board BINARY(16))
	BEGIN

		-- declare the variables used withing the procedure
		DECLARE done INT DEFAULT FALSE;
		DECLARE currentProfileId BINARY(16);
		DECLARE currentPoints MEDIUMINT SIGNED;

		-- cursor to navigate through ledger getting ledgerBoardId
		DECLARE boardCursor CURSOR FOR SELECT ledgerBoardId FROM ledger WHERE ledgerBoardId = board;

		-- avoid error by hitting end of table
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

		-- dropping table if exists
		DROP TEMPORARY TABLE IF EXISTS leaderBoard;

		-- creating temp table for points by profileId on board
		CREATE TEMPORARY TABLE leaderBoard (
			ledgerProfileId BINARY(16) NOT NULL,
			ledgerPoints MEDIUMINT SIGNED
		);

		-- use cursor
		OPEN boardCursor;
		boardLoop: LOOP
			FETCH boardCursor INTO currentProfileId, currentPoints;

			IF done THEN
				LEAVE boardLoop;
			ELSE


				# 			SELECT ledgerProfileId, SUM(ledgerPoints) INTO currentProfileId, currentPoints FROM ledger GROUP BY ledgerProfileId;

				-- alternate version with results placed in descending order
				# 			SELECT ledgerProfileId, SUM(ledgerPoints) total INTO currentProfileId, currentPoints FROM ledger GROUP BY ledgerProfileId ORDER BY SUM(ledgerPoints) DESC;

				-- insert values of current profile id and points into temp table
				INSERT INTO leaderBoard(ledgerProfileId, ledgerPoints) VALUES (currentProfileId, currentPoints);

			END IF;
		END LOOP;

		CLOSE boardCursor;

		# 		SELECT ledgerProfileId, ledgerPoints FROM leaderBoard;

		-- alternate select using descending order by points
		SELECT ledgerProfileId, ledgerPoints from leaderBoard ORDER BY ledgerPoints DESC;

	END //
