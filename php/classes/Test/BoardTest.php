<?php
namespace Edu\Cnm\Kmaru\Test;

use Edu\Cnm\Kmaru\{Profile, Board};

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
		$this->profile = new Profile(generateUuidV4(), null, "@handle", "test@phpunit.de", $this->VALID_PROFILE_HASH, "+12125551212", $this->VALID_PROFILE_SALT);
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
	$pdoBoard = Board::getBoardByBoardId($this->getPDO(), $board->getBoardId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("board"));
	$this->assertEquals($pdoBoard->getBoardId(), $boardId);
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
		$board = new Board($boardId, $this->profile->getProfileId(), $this->VALID_BOARDNAME, $this->VALID_BOARDNAME);
		$board->insert($this->getPDO());

		//edit the Board and update it in mySQL
		$board->setBoardName($this->VALID_BOARDNAME2);
		$board->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoBoard = Board::getBoardByBoardId($this->getPDO(), $board->getBoardId());
		$this->asssertEquals($pdoBoard->getBoardId(), $boardId);
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
		$board = new Board($boardId, $this->profile->getBoardId(), $this->VALID_BOARDNAME);
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





}








?>