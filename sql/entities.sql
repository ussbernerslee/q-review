ALTER DATABASE jeopardy CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- profile table:
CREATE TABLE profile(
-- attribute for primary key:
	profileId BINARY(16) NOT NULL,
	-- attributes for profile:
	profileActivationToken CHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileName VARCHAR(50),
	profilePrivilege CHAR(1),
	profileUsername VARCHAR(50),
	-- verification attributes for entity:
	profileSalt CHAR(64) NOT NULL,
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
	cardID BINARY(16) NOT NULL,
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
	PRIMARY KEY(cardID)
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
	INDEX (boardName),
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
	ledgerType TINYINT UNSIGNED,
	ledgerPoints TINYINT SIGNED,
	-- unique index created:
	UNIQUE (ledgerBoardId),
	UNIQUE (ledgerCardId),
	UNIQUE (ledgerProfileId),
	-- create foreign keys and relationships:
	FOREIGN KEY (ledgerBoardId) REFERENCES board(boardId),
	FOREIGN KEY (ledgerCardId) REFERENCES card(cardId),
	FOREIGN KEY (ledgerProfileId) REFERENCES profile(profileId),
	-- Primary Key (compound key):
	<1-- PRIMARY KEY (ledgerBoardIdl, edgerCardId, ledgerProfileId);             Do we need it?    -->

);