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


}