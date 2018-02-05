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
		return($this->$ledgerBoardId);
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerCardId
	 *
	 * @return Uuid value for $ledgerCardId
	 **/
	public function getLedgerCardId () : Uuid {
		return($this->$ledgerCardId);
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerprofileId
	 *
	 * @return Uuid value for $ledgerProfileId
	 **/
	public function getLedgerProfileId () : Uuid {
		return($this->$ledgerProfileId);
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerType
	 *
	 * @return int unsigned value for $ledgerType
	 **/
	public function getLedgerType () : int {
		return($this->$ledgerType);
	}

//*******************************************************************************************************************

	/**
	 * accessor method for $ledgerPoints
	 *
	 * @return int signed or unsigned value for $ledgerPoints
	 **/
	public function getLedgerPoints () : int {
		return($this->$ledgerPoints);
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
		return ($fields);
	}
}