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
class Ledger {

	private $ledgerBoardId;

	private $ledgerCardId;

	private $ledgerProfileId;

	private $ledgerType;

	private $ledgerPoints;

	public function __construct($newLedgerBoardId, $newLedgerCardId, $newLedgerProfileId, $newLedgerType, $newLedgerPoints) {
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
	 * accessor method for getting LedgerCardId
	 *
	 * @return Uuid value for LedgerCardId
	 **/
	public function getLedgerCardId(): Uuid {
		return ($this->ledgerCardId);
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
	 * accessor method for getting LedgerType
	 *
	 * @return Uuid value for LedgerType
	 **/
	public function getLedgerType(): string {
		return ($this->ledgerType);
	}
	/**
	 * accessor method for getting LedgerPoints
	 *
	 * @return Uuid value for LedgerPoints
	 **/
	public function getLedgerTypes(): string {
		return ($this->ledgerType);
	}

}