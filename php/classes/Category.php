<?php

/*
CREATE TABLE category(
-- attribute for primary key:
	categoryId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	categoryProfileId BINARY(16) NOT NULL,
	-- attributes for category;
	categoryName VARCHAR(64) NOT NULL,
	-- unique index created:
	UNIQUE (categoryId),
	-- create foreign keys and relationships:
	FOREIGN KEY (categoryProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY(categoryId)
);
*/