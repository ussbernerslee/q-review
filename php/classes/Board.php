<?php

/*
CREATE TABLE board(
	-- attribute for primary key:
	boardId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	boardProfileId BINARY(16) NOT NULL,
	-- other attribute for board:
	boardName VARCHAR(64),
	-- unique index created:
	UNIQUE (boardID),
	-- create foreign key and relationships:
	FOREIGN KEY (boardProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY (boardId)
);
*/