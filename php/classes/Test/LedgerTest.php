<?php

namespace Edu\Cnm\Kmaru\Test;

use Edu\Cnm\Kmaru\Profile;
use Edu\Cnm\Kmaru\Board;
use Edu\Cnm\Kmaru\Card;
use Edu\Cnm\Kmaru\Ledger;

// grab autoloader to load classes for testing
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid/php");

/**
 * Full PHPUnit test for the Profile class
 *
 * This is a complete PHPUnit test of the Ledger class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Ledger
 * @author Kenneth Keyes tbennett19@cnm.edu
 **/

class LedgerTest extends KmaruTest {

	/**
	 *  board of the game being played. This is a foreign key relationship
	 * @var Board $board
	 **/
	protected $board;

	/**
	 *  card that is being answered. This is a foreign key relationship
	 * @var Card $card
	 **/
	protected $card;

	/**
	 *  profile that is answering the question. This is a foreign key relationship
	 * @var Profile $profile
	 **/
	protected $profile;

	/**
	 * placeholder until account activation is created
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;

	/**
	 * valid hash to use
	 * @var $VALID_HASH
	 */
	protected $VALID_HASH;

	/**
	 * valid salt to use to create the profile object to own the test
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT;

	/**
	 * valid points to use
	 * @var int $VALID_POINTS
	 **/
	protected $VALID_LEDGER_POINTS;

	/**
	 * valid type to use
	 * @var int $VALID_TYPE
	 **/
	protected $VALID_LEDGER_TYPE;


	/**
	 * create dependant objects before running each test
	 **/
	public final function setUp(): void {

		//run default setUp method first from parent KmaruTest
		parent::setUp();

		// create a salt and hash for the mocked profile
		$password = "poodledoodle2";
		$this->VALID_SALT = bin2hex(random_bytes(32));
		$this->VALID_HASH = hash_pbkdf2("sha512", $password, $this->VALID_SALT, 262144);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

		//create and insert a Profile to answer the cards on the ledger
		$this->profile = new Profile(generateUuidV4(), null, "tbennett19@cnm.edu", $this->VALID_HASH, "Captain Jean-Luc Picard", "123", $this->VALID_SALT, "FinallyWeek5");
		$this->profile->insert($this->getPDO());

		// create and insert a Board to contain the cards contained in the ledger
		$this->profile = new Board(generateUuidV4(), generateUuidV4(), "Treking");
		$this->profile->insert($this->getPDO());

		// create and insert a Card to be answered by the profile on the board for the ledger
		$this->profile = new Card(generateUuidV4(), generateUuidV4(), "Read the Documentation!", 200, "If you are unsure of what you are writing...what should you do next?");
		$this->profile->insert($this->getPDO());
	}

	/**
	 * test inserting a valid ledger and verify that the actual mySQL data matches
	 */
	public function testInsertValidLedger(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("ledger");

		// create a new ledger and insert it into MySQL
		$ledger = new Ledger($this->ledger->getLedgerBoardId(),
			$this->ledger->getLedgerCardId(),
			$this->ledger->getLedgerProfileId(),
			200, 1);
		$ledger->insert($this->getPDO());

		// grab the data from MySQL and enforce the fields match our expectations
		$pdoLedger = Ledger::getLedgersByLedgerBoardIdAndLedgerCardIdAndLedgerProfileId(
			$this->getPDO(),
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId(),
			$this->ledger->getLedgerPoints(),
			$this->ledger->getLedgerType());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("ledger"));
		$this->assertEquals($pdoLedger->getLegerBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoLedger->getLegerCardId(), $this->card->getCardId());
		$this->assertEquals($pdoLedger->getLegerProfileId(), $this->profile->getBoardId());
		$this->assertEquals($pdoLedger->getLedgerPoints(), $this->VALID_LEDGER_POINTS);
		$this->assertEquals($pdoLedger->getLedgerType(), $this->VALID_LEDGER_TYPE);
	}

	/**
	 * test
	 **/




































}