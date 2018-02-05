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
class Ledger implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * board for this ledger by board id: foreign key
	 * @var Uuid $ledgerBoardId
	 **/
	private $ledgerBoardId;
	/**
	 * card for this ledger by card id: foreign key
	 * @var Uuid $ledgerCardId
	 **/
	private $ledgerCardId;
	/**
	 * profile for this ledger by profile id: foreign key
	 * @var Uuid $ledgerProfileId
	 **/
	private $ledgerProfileId;
	/**
	 * type of question, normal, wager, or final for this question stored in ledger
	 * @var string $ledgerType
	 **/
	private $ledgerType;
	/**
	 * question point value stored in ledger
	 * @var int $ledgerPoints
	 **/
	private $ledgerPoints;

	/**
	 * constructor for this Profile
	 *
	 * @param string|Uuid $newLedgerBoardId id of this board for this record in ledger
	 * @param string|Uuid $newLedgerCardId id of the card for this record in ledger
	 * @param string|Uuid $newLedgerProfileId id of this Profile for this record in ledger
	 * @param string $newLedgerType type of question for this record in ledger
	 * @param int $newLedgerPoints signed int value of points for this record in ledger
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newLedgerBoardId, $newLedgerCardId, $newLedgerProfileId, string $newLedgerType, int $newLedgerPoints) {
		try {
			$this->setLedgerBoardId($newLedgerBoardId);
			$this->setLedgerCardId($newLedgerCardId);
			$this->setLedgerProfileId($newLedgerProfileId);
			$this->setLedgerType($newLedgerType);
			$this->setLedgerPoints($newLedgerPoints);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for getting LedgerBoardId
	 *
	 * @return Uuid value for LedgerBoardId
	 **/
	public function getLedgerBoardId(): Uuid {
		return ($this->ledgerBoardId);
	}
	/**
	 * mutator function for ledgerBoardId
	 *
	 * @param Uuid|string $newLedgerBoardId with the value of ledgerBoardId
	 * @throws \RangeException if $newLedgerBoardId is not positive
	 * @throws \TypeError if ledger board id is not positive
	 **/
	public function setLedgerBoardId($newLedgerBoardId): void {
		try {
			$uuid = self::validateUuid($newLedgerBoardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the ledger board id
		$this->ledgerBoardId = $uuid;
	}
	/**
	 * accessor method for getting LedgerCardId
	 *
	 * @return Uuid value for LedgerCardId
	 **/
	public function getLedgerCardId(): Uuid {
		return ($this->ledgerCardId);
	}
	/**
	 * mutator function for ledgerCardId
	 *
	 * @param Uuid|string $newLedgerCardId with the value of ledgerCardId
	 * @throws \RangeException if $newLedgerCardId is not positive
	 * @throws \TypeError if ledger card id is not positive
	 **/
	public function setLedgerCardId($newLedgerCardId): void {
		try {
			$uuid = self::validateUuid($newLedgerCardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the ledger card id
		$this->ledgerCardId = $uuid;
	}
	/**
	 * accessor method for getting LedgerProfileId
	 *
	 * @return Uuid value for LedgerProfileId
	 **/
	public function getLedgerProfileId(): Uuid {
		return ($this->ledgerProfileId);
	}
	/**
	 * mutator function for ledgerProfileId
	 *
	 * @param Uuid|string $newLedgerProfileId with the value of ledgerProfileId
	 * @throws \RangeException if $newLedgerProfileId is not positive
	 * @throws \TypeError if ledger profile id is not positive
	 **/
	public function setLedgerProfileId($newLedgerProfileId): void {
		try {
			$uuid = self::validateUuid($newLedgerProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the ledger profile id
		$this->ledgerProfileId = $uuid;
	}
	/**
	 * accessor method for getting LedgerType
	 *
	 * @return int value for LedgerType
	 **/
	public function getLedgerType(): int {
		return ($this->ledgerType);
	}
	/**
	 * mutator method for ledger type
	 *
	 * @param int $newLedgerType new value of ledger type
	 * @throws \InvalidArgumentException if $newLedgerType is not a string or insecure
	 * @throws \RangeException if $newLedgerType > 255
	 * @throws \TypeError if $newLedgerType is not a string
	 **/
	public function setLedgerType(int $newLedgerType): void {
		// verify the ledger type is secure
		$newLedgerType = trim($newLedgerType);
		$newLedgerType = filter_var($newLedgerType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newLedgerType) === true) {
			throw(new \InvalidArgumentException("ledger type is empty or insecure"));
		}
		// verify the ledger type will fit in the database
		if(strlen($newLedgerType) > 255) {
			throw(new \RangeException("ledger type is too large"));
		}
		// store the ledger type
		$this->ledgerType = $newLedgerType;
	}
	/**
	 * accessor method for getting LedgerPoints
	 *
	 * @return int value for LedgerPoints
	 **/
	public function getLedgerPoints(): int {
		return ($this->ledgerPoints);
	}
	/**
	 * mutator method for ledger points
	 *
	 * @param int $newLedgerPoints new value of ledger points
	 * @throws \InvalidArgumentException if $newLedgerPoints is not an int or insecure
	 * @throws \RangeException if $newLedgerPoints is > 255 characters
	 * @throws \TypeError if $newLedgerPoints is not an int
	 **/
	public function setLedgerPoints(int $newLedgerPoints): void {
		// verify the ledger points are secure
		$newLedgerPoints = trim($newLedgerPoints);
		$newLedgerPoints = filter_var($newLedgerPoints, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newLedgerPoints) === true) {
			throw(new \InvalidArgumentException("ledger points are empty or insecure"));
		}
		// verify the ledger points will fit in the database
		if(strlen($newLedgerPoints) > 255) {
			throw(new \RangeException("ledger points is too large"));
		}
		// store the ledger points
		$this->ledgerPoints = $newLedgerPoints;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["ledgerBoardId"] = $this->ledgerBoardId;
		$fields["ledgerCardId"] = $this->ledgerCardId;
		$fields["ledgerProfileId"] = $this->ledgerprofileId;
		return ($fields);
	}

}