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




-- categories:

INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), UNHEX(REPLACE('C2954660-F27B-4557-8F2D-C68E8B2D8AA8', '-', '')), 'Star Trek Villains');


INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'Star Trek Captains');

INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'Star Trek Kitties');

INSERT INTO category(categoryId, categoryProfileId, categoryName)
VALUES(UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'Star Trek Ships');


-- boards:


INSERT INTO board(boardId, boardProfileId, boardName)
VALUES (UNHEX(REPLACE('0c1c711e-e2e4-439d-9975-9658851b1781', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'DDC');

INSERT INTO board(boardId, boardProfileId, boardName)
VALUES (UNHEX(REPLACE('129c71cf-89e0-4d5d-9968-3c4cf079fd46', '-', '')), UNHEX(REPLACE('C2954660F27B45578F2DC68E8B2D8AA8', '-', '')), 'great game');

-- cards:

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX(REPLACE('32577dd4-4853-4054-a868-d119663f1106', '-', '')), UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 1', '1' , 'The name of the villain 1');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX(REPLACE('d77169b9-f139-487e-b9fd-c91a0d3435bb', '-', '')), UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 2', '2' , 'The name of the villain 2');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('91f5634c-7f7b-437e-bcc0-c69b55db60be', '-', '')),UNHEX (REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 4', '4' , 'The name of the villain 4');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('f7b6b5f9-e4fa-42aa-84a3-770b6938072b', '-', '')),UNHEX (REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), 'who is villain 8', '8' , 'The name of the villain 8');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('155456a2-5926-4071-bfa8-5e21fb5402ae', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 1', '1' , 'The name of the captain 1');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('f182ca2e-84e6-4171-acbd-64f7354a215e', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 2', '2' , 'The name of the captain 2');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('6ce80295-f37c-4baf-9eb5-ce03246c38c9', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 4', '4' , 'The name of the captain 4');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('5ce35d28-9fc9-4092-8fcd-e5d9e41b9dcc', '-', '')),UNHEX (REPLACE('dd02034e-2f70-4ca8-a4bc-416c3eaa0db3', '-', '')), 'who is captain 8', '8' , 'The name of the captain 8');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('fa41de8f-f69b-47cd-8b71-6fff8a3a1185', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 2', '2', 'The name of kitty 2');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('887f97ee-d606-4bbf-afde-b4db4a14d124', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 4', '4', 'The name of kitty 4');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('713d6c92-f9e3-4394-b972-56ff92ad128b', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 32', '32', 'The name of kitty 32');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('dc378e11-8c7d-4086-9238-7b0b76bd9628', '-', '')),UNHEX(REPLACE('0a253dc2-54a1-4985-ae66-dd5aed20b601', '-', '')), 'who is kitty 16', '16', 'The name of kitty 16');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('15beed3c-5abd-4b08-a4ba-c15723be9efc', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')), 'who is ship 16', '16', 'The name of ship 16');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('2c731a3f-c001-4fe8-9886-6984624f7a1a', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')),'who is ship 1', '1', 'The name of ship 1');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('584f6c15-6dbc-420f-854e-35d552235042', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')),'who is ship 8', '8', 'The name of ship 8');

INSERT INTO card(cardId, cardCategoryId, cardAnswer, cardPoints, cardQuestion)
VALUES (UNHEX (REPLACE('39b12f66-f8ab-4ea4-b9cf-c18a202e466b', '-', '')),UNHEX(REPLACE('4e7fc1e6-3c3b-43d7-9a7e-6b97b25e6593', '-', '')),'who is ship 4', '4', 'The name of ship 4');


