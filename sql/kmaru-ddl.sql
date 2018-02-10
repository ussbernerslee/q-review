ALTER DATABASE kmaru CHARACTER SET utf8 COLLATE utf8_unicode_ci;
DROP TABLE IF EXISTS ledger;
DROP TABLE IF EXISTS board;
DROP TABLE IF EXISTS card;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS profile;

-- profile table:
CREATE TABLE profile(
-- attribute for primary key:
	profileId BINARY(16) NOT NULL,
	-- attributes for profile:
	profileActivationToken CHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileName VARCHAR(50),
	profilePrivilege TINYINT UNSIGNED,
	profileSalt CHAR(64) NOT NULL,
	profileUsername VARCHAR(50),
	-- unique index created:
	UNIQUE (profileEmail),
	UNIQUE (profileUsername),
	-- Primary key:
	PRIMARY KEY(profileId)
	);
-- category table:
CREATE TABLE category(
-- attribute for primary key:
	categoryId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	categoryProfileId BINARY(16) NOT NULL,
	-- attributes for category;
	categoryName VARCHAR(64) NOT NULL,
	-- unique index created:
	INDEX (categoryProfileId),
	INDEX (categoryName),
	-- create foreign keys and relationships:
	FOREIGN KEY (categoryProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY(categoryId)
);

-- card table:
CREATE TABLE card(
-- attribute for primary key:
	cardId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	cardCategoryId BINARY(16) NOT NULL,
	-- attributes for card:
	cardAnswer VARCHAR(255) NOT NULL,
	cardPoints TINYINT UNSIGNED,
	cardQuestion VARCHAR(255),
	-- unique index created:
	INDEX (cardCategoryId),
	INDEX (cardPoints),
	-- create foreign keys and relationships:
	FOREIGN KEY (cardCategoryId) REFERENCES category(categoryId),
	-- Primary Key:
	PRIMARY KEY(cardId)
);

-- board table:
CREATE TABLE board(
	-- attribute for primary key:
	boardId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	boardProfileId BINARY(16) NOT NULL,
	-- other attribute for board:
	boardName VARCHAR(64),
	-- unique index created:
	INDEX (boardProfileId),
	-- create foreign key and relationships:
	FOREIGN KEY (boardProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY (boardId)
);

-- ledger table:
CREATE TABLE ledger(
	-- attribute for foreign keys:
	ledgerBoardId BINARY(16) NOT NULL,
	ledgerCardId BINARY(16) NOT NULL,
	ledgerProfileId BINARY(16) NOT NULL,
	-- attributes for ledger:
	ledgerPoints MEDIUMINT SIGNED,
	ledgerType TINYINT UNSIGNED,
	-- unique index created:
	INDEX (ledgerBoardId),
	INDEX (ledgerCardId),
	INDEX (ledgerProfileId),
	-- create foreign keys and relationships:
	FOREIGN KEY (ledgerBoardId) REFERENCES board(boardId),
	FOREIGN KEY (ledgerCardId) REFERENCES card(cardId),
	FOREIGN KEY (ledgerProfileId) REFERENCES profile(profileId),
	-- Primary Key (compound key):
	PRIMARY KEY (ledgerBoardId, ledgerCardId, ledgerProfileId)
);



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
			FETCH boardCursor INTO currentProfileId;

			IF done THEN
				LEAVE boardLoop;
			END IF;

			SELECT ledgerProfileId, SUM(ledgerPoints) INTO currentProfileId, currentPoints FROM ledger GROUP BY ledgerProfileId;

			-- insert values of current profile id and points into temp table
			INSERT INTO leaderBoard(ledgerProfileId, ledgerPoints) VALUES (currentProfileId, currentPoints);
		END LOOP;

		CLOSE boardCursor;

		SELECT ledgerProfileId, ledgerPoints FROM leaderBoard;

	END //
