<?php
namespace Edu\Cnm\Kmaru\Test;

use Edu\Cnm\Kmaru\Profile;
use Edu\Cnm\Kmaru\Board;

//grab the class under scrutiny: Board
require_once(dirname(__DIR__) . "/autoload.php");

//grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit text for the Board class. It is complete
 * because *ALL* mySQL/PDO enabled methods are tested for both
 * invalid and valid inputs.
 *
 * @see Board
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 **/
class BoardTest extends KmaruTest {
	/**
	 * Profile that created the Board; this is for foreign key relations
	 * @var Profile profile
	 **/
	protected $profile = null;

	/**
	 * valid profile hash to create the profile object to own the test
	 * @var $VALID_HASH
	 **/
	protected $VALID_PROFILE_HASH;

	/**
	 * valid salt to use to create the profile object to own the test
	 * @var string $VALID_SALT
	 */
	protected $VALID_PROFILE_SALT;

	/**
	 * name of the Board
	 * @var string $VALID_BOARDNAME
	 **/
	protected $VALID_BOARDNAME = "PHPUnit test passing";

	/**
	 * name of the updated Board
	 * @var string $VALID_BOARDNAME2
	 **/
	protected $VALID_BOARDNAME2 = "PHPUnit test still passing";

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() : void {
		// run the default setUp() method first
		parent::setUp();
		$password = "abc123";
		$this->VALID_PROFILE_SALT = bin2hex(random_bytes(32));
		$this->VALID_PROFILE_HASH = hash_pbkdf2("sha512", $password, $this->VALID_PROFILE_SALT, 262144);

		//create and insert a Profile to own this test Board
		$this->profile = new Profile(generateUuidV4(), null, "email@board.com", $this->VALID_PROFILE_HASH, "John Smith", 3,$this->VALID_PROFILE_SALT, "jsmith");
		$this->profile->insert($this->getPDO());
 	}
/**
 * test inserting a valid Board and verify that the actual mySQL data matches
 **/
public function testInsertValidBoard() : void {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("board");


	// create a new Board and insert to into mySQL
	$boardId = generateUuidV4();
	$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
	$board->insert($this->getPDO());

	//grab the data from mySQL and enforce the fields match our expectations
	$pdoBoard = Board::getBoardByBoardId($this->getPDO(), $this->board->getBoardId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("board"));
	$this->assertEquals($pdoBoard->getBoardId(), $this->board->getBoardId());
	$this->assertEquals($pdoBoard->getBoardProfileId(), $this->profile->getProfileId());
	$this->assertEquals($pdoBoard->getBoardName(), $this->VALID_BOARDNAME);
}
	/**
	 * test inserting a Board, editing it, and then updating it
	 **/
	public function testUpdateValidBoard() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("board");

		//create a new Board and insert into mySQL
		$boardId = generateUuidV4();
		$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
		$board->insert($this->getPDO());

		//edit the Board and update it in mySQL
		$board->setBoardName($this->VALID_BOARDNAME2);
		$board->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBoard = Board::getBoardByBoardId($this->getPDO(), $this->board->getBoardId());
		$this->assertEquals($pdoBoard->getBoardId(), $this->board->getBoardId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("board"));
		$this->assertEquals($pdoBoard->getBoardProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoBoard->getBoardName(), $this->VALID_BOARDNAME2);
	}

	/**
	 * test creating a Board and then deleting it
	 **/
	public function testDeleteValidBoard() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("board");

		//create a new Board and insert it into mySQL
		$boardId = generateUuidV4();
		$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
		$board->insert($this->getPDO());

		//delete the Board from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("board"));
		$this->delete($this->getPDO());

		//grab the data from mySQL and enforce the Board does not exist
		$pdoBoard = Board::getBoardByBoardId($this->getPDO(), $board->getBoardId());
		$this->assertNull($pdoBoard);
		$this->asserEquals($numRows, $this->getConnection()->getRowCount("board"));
	}

	/**
	 * test grabbing a Board that does not exist
	 **/
	public function testGetInvalidBoardByBoardId() : void {
		//grab a board id that exceeds the maximum allowable board id
		$board = Board::getBoardByBoardId($this->getPDO(), generateUuidV4());
		$this->assertNull($board);
	}

	/**
	 * test inserting a Board and re-grabbing it from mySQL
	 **/
	public function testGetValidBoardIdByBoardProfileId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("board");

		//create a new Board and insert it in to mySQL
		$boardId = generateUuidV4();
		$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
		$board->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Board::getBoardByBoardProfileId($this->getPDO(), $this->board->getBoardProfileId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("board"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Board", $results);

		//grab the result from the array and validate it
		$pdoBoard = $results[0];

		$this->assertEquals($pdoBoard->getBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoBoard->getBoardProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoBoard->getBoardName(), $this->VALID_BOARDNAME);
	}

	/**
	 * test grabbing a Board that does not exist
	 **/
	public function testGetInvalidBoardByBoardProfileId(): void {
		// grab a profile id that exceeds the maximum allowable profile id
		$board = Board::getBoardByBoardProfileId($this->getPDO(), generateUuidV4());
		$this->assertCount(0, $board);
	}

	/**
	 * test grabbing a Board by board name
	 **/
	public function testGetValidBoardByBoardName() : void {
		//count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("board");

		//create a new Board and insert it into mySQL
		$boardId = generateUuidV4();
		$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
		$board->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Board::getBoardByBoardName($this->getPDO(), $board->getBoardName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("board"));
		$this->assertCount(1, $results);

		//enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Board", $results);

		//grab the result from the array and validate it
		$pdoBoard = $results[0];
		$this->assertEquals($pdoBoard->getBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoBoard->getBoardProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoBoard->getBoardName(), $this->VALID_BOARDNAME);
	}

	/**
	 * test grabbing a Board by name that does not exist
	 **/
	public function testGetInvalidBoardByBoardName() : void {
		//grab a board by name that does not exist
		$board = Board::getBoardByBoardName($this->getPDO(), "Who is in the brig today?");
		$this->assertCount(0, $board);
	}

	/**
	 * test grabbing all Boards
	 **/
	public function testGetAllValidBoards(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("board");

		//create a new Board and insert it into mySQL
		$boardId = generateUuidV4();
		$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
		$board->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Board::getAllBoards($this->getPDO());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("board"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Board", $results);

		//grab the result from the array and validate it
		$pdoBoard = $results[0];
		$this->assertEquals($pdoBoard->getBoardId(), $this->board->getBoardId());
		$this->assertEquals($pdoBoard->getBoardProfileId(), $this->profile->getprofileId());
		$this->assertEquals($pdoBoard->getBoardName(), $this->VALID_BOARDNAME);
	}


}


?>