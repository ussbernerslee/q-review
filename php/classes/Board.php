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

class Board {

	private $boardId;

	private $boardProfileId;

	private $boardName;

	/**
	 * constructor for new board
	 *
	 * @param string|Uuid $newBoardId
	 * @param string $newBoardProfileId
	 * @param string $newBoardName
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newBoardId, $newBoardProfileId, string $newBoardName) {
		try {
			$this->setBoardId($newBoardId);
			$this->setBoardProfileId($newBoardProfileId);
			$this->setBoardName($newBoardName);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for getting boardId
	 *
	 * @return Uuid value for boardId (or null if new board)
	 **/
	public function getBoardId(): Uuid {
		return ($this->boardId);
	}
	/**
	 * accessor method for getting boardProfileId
	 *
	 * @return Uuid value for boardProfileId
	 **/
	public function getBoardProfileId(): Uuid {
		return ($this->boardProfileId);
	}
	/**
	 * accessor method for getting boardName
	 *
	 * @return string value for boardName
	 **/
	public function getBoardName(): string {
		return ($this->boardName);
	}

}