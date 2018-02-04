<?php
namespace Edu\Cnm\DataDesign;



require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Board
 *
 *
 *
 * @author Kenneth Keyes kkeyes1@cnm.edu updated for /~kkeyes1/data-design
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/
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
	 * mutator function for boardId
	 *
	 * @param Uuid|string $newBoardId with the value of boardId
	 * @throws \RangeException if $newBoardId is not positive
	 * @throws \TypeError if card id is not positive
	 **/
	public function setBoardId($newBoardId): void {
		try {
			$uuid = self::validateUuid($newBoardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the card id
		$this->boardId = $uuid;
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