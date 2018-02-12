<?php

namespace Edu\Cnm\Kmaru\Test;


use Edu\Cnm\Kmaru\Profile;
use Edu\Cnm\Kmaru\Category;
use Edu\Cnm\Kmaru\Card;
use Edu\Cnm\Kmaru\Board;
use Edu\Cnm\Kmaru\Ledger;

// grab autoloader to load classes for testing
require_once(dirname(__DIR__, 1) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Profile class
 *
 * This is a complete PHPUnit test of the Ledger class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Ledger
 * @author Tristan Bennett tbennett19@cnm.edu
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
	 *  profile (player) that is answering the question. This is a foreign key relationship
	 * @var Profile $profile
	 **/
	protected $profile;


	/**
	 *  category that is holds the cards
	 * @var Category $category
	 **/
	protected $category;

	/**
	 * profile of creator of category, card, and board; this is the captain
	 **/
	protected $profileCaptain;

	/**
	 * placeholder until account activation is created
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;

	/**
	 * placeholder until account activation is created of captain
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION_CAPTAIN;

	/**
	 * valid hash to use of player
	 * @var $VALID_HASH
	 */
	protected $VALID_HASH;

	/**
	 * valid hash to use for captain
	 * @var $VALID_HASH
	 */
	protected $VALID_HASH_CAPTAIN;

	/**
	 * valid salt to use to create the profile of player
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT;

	/**
	 * valid salt to use to create the profile for captain
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT_CAPTAIN;

	/**
	 * valid points to use
	 * @var int $VALID_POINTS
	 **/
	protected $VALID_LEDGER_POINTS = 200;

	/**
	 * valid type to use
	 * @var int $VALID_TYPE
	 **/
	protected $VALID_LEDGER_TYPE = 2;


	/**
	 * create dependant objects before running each test
	 **/
	public final function setUp(): void {

		//run default setUp method first from parent KmaruTest
		parent::setUp();

		// create a salt and hash for the mocked captain profile
		$passwordCaptain = "poodledoodle2";
		$this->VALID_SALT_CAPTAIN = bin2hex(random_bytes(32));
		$this->VALID_HASH_CAPTAIN = hash_pbkdf2("sha512", $passwordCaptain, $this->VALID_SALT_CAPTAIN, 262144);
		$this->VALID_ACTIVATION_CAPTAIN = bin2hex(random_bytes(16));

		//create and insert a Profile to create the category, card, and board
		$this->profileCaptain = new Profile(generateUuidV4(), null, "deepdivedylan@cnm.edu", $this->VALID_HASH_CAPTAIN, "Captain Jean-Luc Picard", 123, $this->VALID_SALT_CAPTAIN, "FinallyWeek5");
		$this->profileCaptain->insert($this->getPDO());

		// create a salt and hash for the mocked player profile
		$password = "resistance";
		$this->VALID_SALT = bin2hex(random_bytes(32));
		$this->VALID_HASH = hash_pbkdf2("sha512", $password, $this->VALID_SALT, 262144);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

		//create and insert a Profile to play the game and answer questions
		$this->profile = new Profile(generateUuidV4(), null, "nat@cnm.edu", $this->VALID_HASH, "Nat in the Brig", 0, $this->VALID_SALT, "BrigPartyHost");
		$this->profile->insert($this->getPDO());

		// create and insert a Category to house the cards in the ledger
		$this->category = new Category(generateUuidV4(), $this->profileCaptain->getProfileId(), "CSS");
		$this->category->insert($this->getPDO());

		// create and insert a Card to be answered by the profile on the board for the ledger
		$this->card = new Card(generateUuidV4(), $this->category->getCategoryId(), "Read the Documentation!", $this->VALID_LEDGER_POINTS, "If you are unsure of what you are writing...what should you do next?");
		$this->card->insert($this->getPDO());


		// create and insert a Board to contain the cards contained in the ledger
		$this->board = new Board(generateUuidV4(), $this->profileCaptain->getProfileId(), "Treking");
		$this->board->insert($this->getPDO());

	}

	/**
	 * test inserting a valid ledger and verify that the actual mySQL data matches
	 */
	public function testInsertValidLedger(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("ledger");

		// create a new ledger and insert it into MySQL
		$ledger = new Ledger(
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId(),
			$this->VALID_LEDGER_POINTS,
			$this->VALID_LEDGER_TYPE);
		$ledger->insert($this->getPDO());

		// grab the data from MySQL and enforce the fields match our expectations
		$pdoLedger = Ledger::getLedgerByLedgerBoardIdAndLedgerCardIdAndLedgerProfileId(
			$this->getPDO(),
			$ledger->getLedgerBoardId(),
			$ledger->getLedgerCardId(),
			$ledger->getLedgerProfileId());

		// assuming these now exist, checking values to originals
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("ledger"));
		$this->assertEquals($pdoLedger->getLedgerBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoLedger->getLedgerCardId(), $this->card->getCardId());
		$this->assertEquals($pdoLedger->getLedgerProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoLedger->getLedgerPoints(), $this->VALID_LEDGER_POINTS);
		$this->assertEquals($pdoLedger->getLedgerType(), $this->VALID_LEDGER_TYPE);
	}

	/**
	 * test inserting a ledger and grabbing it by ledger board id and ledger profile id
	 **/



	/**
	 * test creating and then deleting valid ledger
	 **/
	public function testDeleteValidLedger() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("ledger");

		// create a new ledger and insert it into MySQL
		$ledger = new Ledger(
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId(),
			$this->VALID_LEDGER_POINTS,
			$this->VALID_LEDGER_TYPE);
		$ledger->insert($this->getPDO());

		// Delete the Ledger from MySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("ledger"));
		$ledger->delete($this->getPDO());

		// grab the data from MySQL and check to see if the Ledger does still exist
		$pdoLedger = Ledger::getLedgerByLedgerBoardIdAndLedgerCardIdAndLedgerProfileId(
			$this->getPDO(),
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId());

		// assuming it does not exit anymore
		$this->assertNull($pdoLedger);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("ledger"));
	}

	/**
	 * test grabbing a Ledger that does not exist
	 **/
	public function testGetInvalidLedgersByLedgerBoardIdAndLedgerCardIdAndLedgerProfileId() : void {

		// try to grab a Leger by an incorrect ledger board Id and ledger card id and ledger profile id
		$ledger = Ledger::getLedgerByLedgerBoardIdAndLedgerCardIdAndLedgerProfileId(
				$this->getPDO(), generateUuidV4(), generateUuidV4(), generateUuidV4());

		//asserting that it is incorrect
		$this->assertEquals(0, $ledger);
}






	/**
	 * test grabbing a Ledger by ledger board id
	 **/
	public function testGetValidLedgerByLedgerBoardId() : void {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("ledger");

		// create a new ledger and insert it into MySQL
		$ledger = new Ledger(
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId(),
			$this->VALID_LEDGER_POINTS,
			$this->VALID_LEDGER_TYPE);
		$ledger->insert($this->getPDO());

		// grab the data from MySQL and make sure the fields match our expectations
		$results = Ledger::getLedgersByLedgerBoardId($this->getPDO(), $ledger->getLedgerBoardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("ledger"));
		$this->assertCount(1, $results);

		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Ledger", $results);

		// grab the result from the array and validate it
		$pdoLedger = $results[0];
		$this->assertEquals($pdoLedger->getLedgerBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoLedger->getLedgerCardId(), $this->card->getCardId());
		$this->assertEquals($pdoLedger->getLedgerProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoLedger->getLedgerPoints(), $this->VALID_LEDGER_POINTS);
		$this->assertEquals($pdoLedger->getLedgerType(), $this->VALID_LEDGER_TYPE);
	}

	/**
	 * test grabbing Ledger by a ledger  board Id that does not exist
	 **/
	public function testGetInvalidLedgerByLedgerBoardId() : void {
		// try to grab a Leger by an incorrect ledger board Id
		$ledger = Ledger::getLedgersByLedgerBoardId(
			$this->getPDO(), generateUuidV4());

		//asserting that it is incorrect
		$this->assertCount(0, $ledger);
	}

	/**
	 * test grabbing a Ledger by ledger card id
	 **/
	public function testGetValidLedgerByLedgerCardId() : void {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("ledger");

		// create a new ledger and insert it into MySQL
		$ledger = new Ledger(
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId(),
			$this->VALID_LEDGER_POINTS,
			$this->VALID_LEDGER_TYPE);
		$ledger->insert($this->getPDO());

		// grab the data from MySQL and make sure the fields match our expectations
		$results = Ledger::getLedgersByLedgerCardId($this->getPDO(), $ledger->getLedgerCardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("ledger"));
		$this->assertCount(1, $results);

		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Ledger", $results);

		// grab the result from the array and validate it
		$pdoLedger = $results[0];
		$this->assertEquals($pdoLedger->getLedgerBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoLedger->getLedgerCardId(), $this->card->getCardId());
		$this->assertEquals($pdoLedger->getLedgerProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoLedger->getLedgerPoints(), $this->VALID_LEDGER_POINTS);
		$this->assertEquals($pdoLedger->getLedgerType(), $this->VALID_LEDGER_TYPE);
	}

	/**
	 * test grabbing Ledger by a ledger card Id that does not exist
	 **/
	public function testGetInvalidLedgerByLedgerCardId() : void {
		// try to grab a Leger by an incorrect ledger card Id
		$ledger = Ledger::getLedgersByLedgerCardId(
			$this->getPDO(), generateUuidV4());

		//asserting that it is incorrect
		$this->assertCount(0, $ledger);
	}

	/**
	 * test grabbing a Ledger by ledger profile id
	 **/
	public function testGetValidLedgerByLedgerProfileId() : void {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("ledger");

		// create a new ledger and insert it into MySQL
		$ledger = new Ledger(
			$this->board->getBoardId(),
			$this->card->getCardId(),
			$this->profile->getProfileId(),
			$this->VALID_LEDGER_POINTS,
			$this->VALID_LEDGER_TYPE);
		$ledger->insert($this->getPDO());

		// grab the data from MySQL and make sure the fields match our expectations
		$results = Ledger::getLedgersByLedgerProfileId($this->getPDO(), $ledger->getLedgerProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("ledger"));
		$this->assertCount(1, $results);

		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Ledger", $results);

		// grab the result from the array and validate it
		$pdoLedger = $results[0];
		$this->assertEquals($pdoLedger->getLedgerBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoLedger->getLedgerCardId(), $this->card->getCardId());
		$this->assertEquals($pdoLedger->getLedgerProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoLedger->getLedgerPoints(), $this->VALID_LEDGER_POINTS);
		$this->assertEquals($pdoLedger->getLedgerType(), $this->VALID_LEDGER_TYPE);
	}

	/**
	 * test grabbing Ledger by a ledger profile Id that does not exist
	 **/
	public function testGetInvalidLedgerByLedgerProfileId() : void {
		// try to grab a Leger by an incorrect ledger profile Id
		$ledger = Ledger::getLedgersByLedgerProfileId(
			$this->getPDO(), generateUuidV4());

		//asserting that it is incorrect
		$this->assertCount(0, $ledger);
	}


	/**
	 * test the getting the points on the ledger by a valid ledger board id
	 **/
	public function testGetPointsOnBoard() {
		// create a query template to CALL the stored procedure
		$pdo = $this->getPDO();
		$query = "SELECT getPointsOnBoard(:boardId) AS points";
		$statement = $pdo->prepare($query);

		// bind the parameters to the stored procedure
		$parameters = array("boardId" => $this->board->getBoardId());
		$statement->execute($parameters);

		// returns the values in each place of the array
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$result = $statement->fetch();
		$points = $result["points"];

		// assert the answer is the expected answer within a margin of error (needed for doubles)

		//TODO: make this a state variable? to test...
		$this->assertEquals($points, $this->VALID_LEADERBOARD_POINTS);

	}

}