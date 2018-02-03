ALTER DATABASE akhamsamran1 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- profile table:
CREATE TABLE profile(
-- attribute for primary key:
	profileId BINARY(16) NOT NULL,
	-- attributes for profile:
	profileActivationToken CHAR(32),
	profileName VARCHAR(50),
	profilePrivilege CHAR(1),
	profileUsername VARCHAR(50),
	-- verification attributes for entity:
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	-- unique index created:
	UNIQUE (profileId),
	-- Primary key:
	PRIMARY KEY(profileId)
	);

-- category table:
CREATE TABLE category(
-- attribute for primary key:
	categoryID BINARY(16) NOT NULL,
	-- attribute for foreign key:
	categoryProfileID BINARY(16) NOT NULL,
	-- attributes for category;
	categoryName VARCHAR(64) NOT NULL,
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
	-- Primary Key:
	PRIMARY KEY(cardID)
);