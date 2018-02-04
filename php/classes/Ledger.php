<?php

/*
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
	PRIMARY KEY (ledgerBoardId),
	PRIMARY KEY (ledgerCardId),
	PRIMARY KEY (ledgerProfileId)
);
*/