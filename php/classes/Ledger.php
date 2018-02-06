<?php

namespace Edu\Cnm\DataDesign;



require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;


/**
 * Ledger for kmaru game
 *
 * The ledger will record all interactions with the game, documenting points gained and lost by each player on each question
 * as it relates to the the board.
 *
 * The ledger contains a composite primary key of $ledgerBoardId, $ledgerCardId, and $ledgerProfileId.
 *
 * @author Tristan Bennett <tbennett19@cnm.edu> updated for kmaru capstone
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/
//TODO: add correct namespace and package
class Ledger implements \JsonSerializable {

	/**
	 * id for the board on this ledger: this is a foreign key
	 *
	 * @var Uuid $ledgerBoardId
	 **/
	private $ledgerBoardId;

	/**
	 * id for the card on this ledger: this is a foreign key
	 *
	 * @var Uuid $ledgerCardId
	 **/
	private $ledgerCardId;

	/**
	 * id for the Profile on this ledger: this is a foreign key
	 *
	 * @var Uuid $ledgerProfileId
	 **/
	private $ledgerProfileId;

	/**
	 * type of question in ledger: normal (1), wager (2), and final (3)
	 *
	 * @var String $ledgerType
	 **/
	private $ledgerType;

	/**
	 * points awarded or taken by question on this ledger
	 *
	 * @var Uuid $ledgerPoints
	 **/
	private $ledgerPoints;

//******************************************************************************************************************

	//TODO: constructor

//******************************************************************************************************************

	/**
	 * accessor method for $ledgerBoardId
	 *
	 * @return Uuid value for $ledgerBoardId
	 **/
	public function getLedgerBoardId () : Uuid {
		return($this->ledgerBoardId);
	}

	/**
	 * mutator for ledgerBoardId
	 *
	 * @param Uuid|string $newLedgerBoardId is a new value for ledgerBoardId
	 * @throws \RangeException if $newLedgerBoardId is not positive
	 * @throws \TypeError if $newLedgerBoardId is not a Uuid or string
	 */
	public function setLedgerBoardId($newLedgerBoardId): void {
		try {
			$uuid = self::validateUuid($newLedgerBoardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store profileId
		$this->ledgerBoardId = $uuid;
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerCardId
	 *
	 * @return Uuid value for $ledgerCardId
	 **/
	public function getLedgerCardId () : Uuid {
		return($this->ledgerCardId);
	}

	/**
	 * mutator for ledgerCardId
	 *
	 * @param Uuid|string $newLedgerCardId is a new value for ledgerCardId
	 * @throws \RangeException if $newLedgerCardId is not positive
	 * @throws \TypeError if $newLedgerBoardId is not a Uuid or string
	 */
	public function setLedgerCardId($newLedgerCardId): void {
		try {
			$uuid = self::validateUuid($newLedgerCardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store profileId
		$this->ledgerCardId = $uuid;
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerprofileId
	 *
	 * @return Uuid value for $ledgerProfileId
	 **/
	public function getLedgerProfileId () : Uuid {
		return($this->ledgerProfileId);
	}

	/**
	 * mutator for ledgerProfileId
	 *
	 * @param Uuid|string $newLedgerProfileId is a new value for ledgerProfileId
	 * @throws \RangeException if $newLedgerProfileId is not positive
	 * @throws \TypeError if $newLedgerProfileId is not a Uuid or string
	 */
	public function setLedgerProfileId($newLedgerProfileId): void {
		try {
			$uuid = self::validateUuid($newLedgerProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store profileId
		$this->ledgerProfileId = $uuid;
	}
//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerPoints
	 *
	 * @return int signed or unsigned value for $ledgerPoints
	 **/
	public function getLedgerPoints () : int {
		return($this->ledgerPoints);
	}

	/**
	 * mutator method for ledger points $ledgerPoints
	 *
	 * @param int $newLedgerPoints ew value of ledger points
	 * @throws \InvalidArgumentException if $newLedgerPoints is not an int or insecure
	 * @throws \RangeException if $newLedgerPoints is > 255 characters
	 * @throws \TypeError if $newLedgerPoints is not an int
	 **/
	public function setLedgerPoints(int $newLedgerPoints): void {
		// verify the ledger points are integers
		$newLedgerPoints = filter_var($newLedgerPoints, FILTER_VALIDATE_INT);
		if(is_int($newLedgerPoints) !== true) {
			throw(new \InvalidArgumentException("ledger points is not an integer"));
		}
		// verify the ledger points will fit in the database
		if($newLedgerPoints > 	8388607) {
			throw(new \RangeException("ledger points is too large"));
		}
		// store the ledger points
		$this->ledgerPoints = $newLedgerPoints;
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerType
	 *
	 * @return int unsigned value for $ledgerType
	 **/
	public function getLedgerType () : int {
		return($this->ledgerType);
	}

	/**
	 * mutator method for ledgerType
	 *
	 * @param int $newLedgerType new value of ledger type
	 * @throws \InvalidArgumentException if $newLedgerType is not an int or insecure
	 * @throws \RangeException if $newLedgerType > 255
	 * @throws \TypeError if $newLedgerType is not an int
	 **/
	public function setLedgerType(int $newLedgerType): void {
		// verify the ledger type is secure

		//TODO: get this checked
		$newLedgerType = filter_var($newLedgerType, FILTER_VALIDATE_INT);
		if(in_int($newLedgerType) !== true) {
			throw(new \InvalidArgumentException("Ledger type is not an integer"));
		}
		// verify the ledger type will fit the game set up
		if($newLedgerType <= 0 || $newLedgerType > 3) {
			throw(new \RangeException("ledger type out of expected range"));
		}
		// store the ledger type
		$this->ledgerType = $newLedgerType;
	}

//*******************************************************************************************************************

	/**
	 * inserts a new ledger into mySQL
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// creates the query template. Ready to be formatted and inserted
		$query = "INSERT INTO ledger(ledgerBoardId, ledgerCardId, ledgerProfileId, ledgerPoints, ledgerType) VALUES (:ledgerBoardId, :ledgerCardId, :ledgerProfileId, :ledgerPoints, :ledgerType)";

		// stops direct insert for security reasons. Allows for further formatting.
		$statement = $pdo->prepare($query);

		// bind values of variables to respective placeholders in template
		$parameters = ["ledgerBoardId" => $this->ledgerBoardId->getBytes(), "ledgerCardId" => $this->ledgerCardId->getBytes(), "ledgerProfileId" => $this->ledgerProfileId->getBytes(), "ledgerPoints" => $this->ledgerPoints, "ledgerType => $this->ledgerType"];
		$statement->execute($parameters);
	}

//*******************************************************************************************************************

	/**
	 * Deletes selected ledger from mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM ledger WHERE ledgerBoardId = :ledgerBoardId AND ledgerCardId = :ledgerCardId AND ledgerProfileId = :ledgerProfileId";

		// stops direct deletion
		$statement = $pdo->prepare($query);

		// binds binary value of articleId to placeholder for profileId
		$parameters = ["ledgerBoardId" => $this->ledgerBoardId->getBytes(), "ledgerCardId" => $this->ledgerCardId->getBytes(), "ledgerProfileId" => $this->ledgerProfileId->getBytes()];
		$statement->execute($parameters);
	}

//*******************************************************************************************************************

	/**
	 * gets ledger by ledger board id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $ledgerBoardId ledger board id to search by
	 * @return Ledger|null Ledger found or null if not found
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError when a variable is not the correct data type
	 **/
	public static function getLedgerByLedgerBoardId(\PDO $pdo, $ledgerBoardId) : ?Ledger {
		// sanitize the ledgerBoardId before searching
		try {
			$ledgerBoardId = self::validateUuid($ledgerBoardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT ledgerBoardId, ledgerCardId, ledgerProfileId, ledgerPoints, ledgerType FROM ledger WHERE ledgerBoardId = :ledgerBoardId";

		// stops direct access to database for formatting
		$statement = $pdo->prepare($query);

		// bind the article id to the place holder in the template
		$parameters = ["ledgerBoardId" => $ledgerBoardId->getBytes()];
		$statement->execute($parameters);

		// grab the Ledger from mySQL
		try {
			$ledger = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$ledger = new Ledger($row["ledgerBoardId"], $row["ledgerCardId"], $row["ledgerProfileId"], $row["ledgerPoints"], $row["ledgerType"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow the exception
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($ledger);
	}

//*******************************************************************************************************************
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["ledgerBoardId"] = $this->ledgerBoardId->toString();
		$fields["ledgerCardId"] = $this->ledgerCardId->toString();
		$fields["ledgerProfileId"] = $this->ledgerProfileId->toString();
		$fields["ledgerPoints"] = $this->ledgerPoints;
		$fields["ledgerType"] = $this->ledgerType;
		return ($fields);
	}
}