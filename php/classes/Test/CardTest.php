<?php
namespace Edu\Cnm\Kmaru\Test;
use Edu\Cnm\Kmaru\{Category, Card, Profile};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");
/**
 * Full PHPUnit test for the Card class
 *
 * This is a complete PHPUnit test of the Card class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Card
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @author Freddy Crawford <fcrawford@cnm.edu>
 **/
class CardTest extends KmaruTest {
	/**
	 * profile that populates the Category id; this is for foreign key relations
	 * @var Uuid profileId for categoryId
	 **/
	protected $profile;
	/**
	 * Category that populates the Card; this is for foreign key relations
	 * @var  Uuid card category
	 **/
	protected $category;
	/**
	 * valid answer to use
	 * @var string $VALID_CARD_ANSWER
	 */
	protected $VALID_CARD_ANSWER = "What is...Inline-Block";
	/**
	 * valid point value for the card
	 * @var int $VALID_CARD_POINTS
	 */
	protected $VALID_CARD_POINTS = 32;
	/**
	 * valid question for the card
	 * @var string $VALID_CARD_QUESTION
	 */
	protected $VALID_CARD_QUESTION = "What is the Display property that lets an inline item function like a block?";
	/**
	 * question for the updated card
	 * @var string $VALID_CARD_QUESTION2
	 */
	protected $VALID_CARD_QUESTION2 = "Who is the founder of Ethereum?";
	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();

		$password = "qwertyuiop";
		$this->VALID_PROFILE_SALT = bin2hex(random_bytes(32));
		$this->VALID_PROFILE_HASH = hash_pbkdf2("sha512", $password, $this->VALID_PROFILE_SALT, 262144);

		//create and insert a Profile to own this test Category
		$this->profile = new Profile(generateUuidV4(), null, "@handle", $this->VALID_PROFILE_HASH, "harvey dent", "1", $this->VALID_PROFILE_SALT,"happygirl");
		$this->profile->insert($this->getPDO());

		// create and insert a category to own the test card
		$this->category = new Category(generateUuidV4(), $this->profile->getProfileId(), "CSS");
		$this->category->insert($this->getPDO());
	}
	/**
	 * test inserting a valid Card and verify that the actual mySQL data matches
	 **/
	public function testInsertValidCard(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");
		// create a new Card and insert to into mySQL
		$cardId = generateUuidV4();
		$card = new Card($cardId, $this->category->getCategoryId(), $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION);
		$card->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCard = Card::getCardByCardId($this->getPDO(), $card->getCardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$this->assertEquals($pdoCard->getCardId(), $cardId);
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->VALID_CARD_ANSWER);
		$this->assertEquals($pdoCard->getCardPoints(), $this->VALID_CARD_POINTS);
		$this->assertEquals($pdoCard->getCardQuestion(), $this->VALID_CARD_QUESTION);

	}

	/**
	 * test updating a valid Card and verify that the actual mySQL data matches
	 **/
	public function testUpdateValidCard(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");
		// create a new Card and insert to into mySQL
		$cardId = generateUuidV4();
		$card = new Card($cardId, $this->category->getCategoryId(), $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION);
		$card->insert($this->getPDO());
		// edit the card and update it in mySQL
		$card->setCardQuestion($this->VALID_CARD_QUESTION2);
		$card->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCard = Card::getCardByCardId($this->getPDO(), $card->getCardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$this->assertEquals($pdoCard->getCardId(), $cardId);
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->VALID_CARD_ANSWER);
		$this->assertEquals($pdoCard->getCardPoints(), $this->VALID_CARD_POINTS);
		$this->assertEquals($pdoCard->getCardQuestion(), $this->VALID_CARD_QUESTION2);

	}

	/**
	 * test creating a Card and then deleting it
	 **/
	public function testDeleteValidCard(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");
		// create a new Card and insert to into mySQL


		$cardId = generateUuidV4();
		$card = new Card($cardId, $this->category->getCategoryId(), $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION2);
		$card->insert($this->getPDO());



		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$card->delete($this->getPDO());

		$pdoCard = Card::getCardByCardId($this->getPDO(), $card->getCardId());
		$this->assertNull($pdoCard);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("card"));


	}


	/**
	 * test inserting a Card and regrabbing it from mySQL
	 **/
	public function testGetValidCardByCardCategoryId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");

		// create a new Card and insert to into mySQL
		$cardId = generateUuidV4();
		$card = new Card($cardId, $this->category->getCategoryId(), $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION);
		$card->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Card::getCardByCardCategoryId($this->getPDO(), $card->getCardCategoryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);

		// grab the result from the array and validate it
		$pdoCard = $results[0];
		$this->assertEquals($pdoCard->getCardId(), $cardId);
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->VALID_CARD_ANSWER);
		$this->assertEquals($pdoCard->getCardPoints(), $this->VALID_CARD_POINTS);
		$this->assertEquals($pdoCard->getCardQuestion(), $this->VALID_CARD_QUESTION);

	}

	/**
	 * test grabbing a Card by cardCategoryId that does not exist
	 **/
	public function testGetInvalidCardByCardCategoryId() : void {
		// grab a card category id that does not exist
		$fakeCardCategoryId = generateUuidV4();
		$card = Card::getCardByCardCategoryId($this->getPDO(), generateUuidV4());
		$this->assertCount(0, $card);
	}


	/**
	 * test inserting a Card and regrabbing it from mySQL
	 **/
	public function testGetValidCardByCardId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");

		// create a new Card and insert to into mySQL
		$cardId = generateUuidV4();
		$card = new Card($cardId, $this->category->getCategoryId(), $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION);
		$card->insert($this->getPDO());

		// grab the result from the array and validate it
		$pdoCard = Card::getCardByCardId($this->getPDO(), $card->getCardId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$this->assertEquals($pdoCard->getCardId(), $cardId);
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->VALID_CARD_ANSWER);
		$this->assertEquals($pdoCard->getCardPoints(), $this->VALID_CARD_POINTS);
		$this->assertEquals($pdoCard->getCardQuestion(), $this->VALID_CARD_QUESTION);


	}

	/**
	 * test grabbing a Card that does not exist
	 **/
	public function testGetInvalidCardByCardId() : void {
		// grab a card category id that does not exist
		$card = Card::getCardByCardId($this->getPDO(), generateUuidV4());
		$this->assertEquals(0, $card);
	}

	/**
	 * test inserting a Card and regrabbing it from mySQL
	 **/
	public function testGetValidCardByCardPoints() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");

		$cardId = generateUuidV4();
		$card = new Card($cardId, $this->category->getCategoryId(), $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION);
		$card->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Card::getCardByCardPoints($this->getPDO(), $this->VALID_CARD_POINTS);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));

		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);
		// grab the result from the array and validate it


		$pdoCard = $results[0];
		$this->assertEquals($pdoCard->getCardId(), $cardId);
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->VALID_CARD_ANSWER);
		$this->assertEquals($pdoCard->getCardPoints(), $this->VALID_CARD_POINTS);
		$this->assertEquals($pdoCard->getCardQuestion(), $this->VALID_CARD_QUESTION);

	}

	/**
	 * test grabbing a Card by cardPoints that does not exist
	 **/
	public function testGetInvalidCardByCardPoints() : void {
		// grab a card point value that does not exist
		$card = Card::getCardByCardPoints($this->getPDO(), 16);
		$this->assertCount(0, $card);
	}

}