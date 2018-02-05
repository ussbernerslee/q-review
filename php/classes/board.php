<?php
namespace Edu\Cnm\DataDesign;



require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use PHPUnit\Exception;
use Ramsey\Uuid\Uuid;

/**
 * board
 *
 * This is what data is stored when a captain/instructor/proctor (the person running the game) creates a board.
 * This sets the "name" of each specific game for the ledger.
 *
 * @author AnnaKhamsamran <akhamsamran1@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/

class Board implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this Board; this is the primary key
	 * @var Uuid $boardId
	 **/
	private $boardId;
	/**
	 * id of the Profile that created this Board; this is a foreign key
	 * @var Uuid $boardProfileId
	 **/
	private $boardProfileId;
	/**
	 * name of the board-this is to distinguish between games within the ledger
	 * @var string $boardName
	 **/
	private $boardName;

	/**
	 * constructor for this Board
	 *
	 * @param string|Uuid $newBoardId id of this Board or null if new Board
	 * @param string|Uuid $newBoardProfileId id of the Profile of the creator of this Board
	 * @param string $newBoardName the Name of this Board
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds(ie strings too long, integers negative)
	 * @throws \TypeError if data types violates type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php (constructors and destructors)
	 **/
	public function __construct($newBoardId, $newBoardProfileId, string $newBoardName) {
		try {
			$this->setBoardId($newBoardId);
			$this->setBoardProfileId($newBoardProfileId);
			$this->setBoardName($newBoardName);
		}
		//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception)),
		}
	}
	/**
	 * accessor method for board id
	 *
	 * @return Uuid value of the board id
	 **/
	public function getBoardId() : Uuid {
		return($this->boardId);
	}
	/**
	 * mutator method for board id
	 *
	 * @param Uuid | string $newBoardId
	 * @throws \RangeException if $newBoardId is not positive
	 * @throws \TypeError if $newBoardId is not a uuid or string
	 **/
	public function setBoardId($newBoardId) : void {
		try {
			$uuid = self::validateUuid($newBoardId)
		}
		cath(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the board id
		$this->boardId = $uuid;
	}

	/**
	 * accessor method for board profile id
	 *
	 * @return Uuid value of board profile id
	 **/
	public function getBoardProfileId() : Uuid {
		return($this->bordProfileId);
	}
	/**
	 * mutator method for board profile id
	 *
	 * @param string | Uuid $newBoardProfileId new value of board profile id
	 * @throws \RangeException if $newBordProfileId is not positive
	 */





}
?>