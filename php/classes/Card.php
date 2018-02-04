<?php

/*
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
	UNIQUE (cardId),
	-- create foreign keys and relationships:
	FOREIGN KEY (cardCategoryId) REFERENCES category(categoryId),
	-- Primary Key:
	PRIMARY KEY(cardID)
);
*/