ALTER DATABASE akhamsamran1 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- profile table:

CREATE TABLE profile(
-- attribute for primary key:
	profileId BINARY(16) NOT NULL,
	--attributes for profile:
	profileActivationToken CHAR(32),
	profileHash CHAR(128),
	profileName VARCHAR(50),
	profilePrivilege CHAR(1),
	profileSalt CHAR(64),
	profileUsername VARCHAR(50),
	--verification attributes for entity:
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	-- unique index created:
	UNIQUE (profileId),
	-- Primary key:
	PRIMARY KEY(profileId)
