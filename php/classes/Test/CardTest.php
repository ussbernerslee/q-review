<?php
namespace Edu\Cnm\Kmaru\Test;
use Edu\Cnm\Kmaru\{Category, Card};
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
	 * Category that populates the Card; this is for foreign key relations
	 * @var  Category category
	 **/
	protected $category = null;
	/**
	 * valid answer to use
	 * @var $VALID_CARD_ANSWER
	 */
	protected $VALID_CARD_ANSWER;
	/**
	 * valid point value for the card
	 * @var string $VALID_CARD_POINTS
	 */
	protected $VALID_CARD_POINTS;
	/**
	 * valid question for the card
	 * @var string $VALID_CARD_QUESTION
	 */
	protected $VALID_CARD_QUESTION;
	/**
	* question for the updated card
	* @var string $VALID_CARD_QUESTION2
	*/
	protected $VALID_CARD_QUESTION2;
	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
		// create and insert a category to own the test card
		$this->category = new Category(generateUuidV4(), generateUuidV4(), "CSS");
		$this->category->insert($this->getPDO());
		// create the card and insert the mocked card
	}
		/**
		 * test inserting a valid Card and verify that the actual mySQL data matches
		 **/
		public
		function testInsertValidCard(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL
			$cardId = generateUuidV4();
			$cardCategoryId = generateUuidV4();
			$card = new Card($cardId, $cardCategoryId, $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION2);
			$card->insert($this->getPDO());
			// grab the data from mySQL and enforce the fields match our expectations
			$pdoCard = Card::getCardByCardId($this->getPDO(), $card->getCardId());
			$this->assertEquals($pdoCard->getCardId(), $cardId);
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
			$this->assertEquals($pdoCard->getCardId(), $this->category->getCardId());
			$this->assertEquals($pdoCard->getCardCategoryId(), $this->card->getCardCategoryId());
			$this->assertEquals($pdoCard->getCardAnswer(), $this->card->getCardAnswer());
			$this->assertEquals($pdoCard->getCardPoints(), $this->card->getCardPoints());
			$this->assertEquals($pdoCard->getCardQuestion(), $this->card->getCardQuestion());

		}

		/**
		 * test creating a Card and then deleting it
		 **/
		public
		function testDeleteValidCard(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL

			$cardId = generateUuidV4();
			$cardCategoryId = generateUuidV4();
			$card = new Card($cardId, $cardCategoryId, $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION2);
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
		$cardCategoryId = generateUuidV4();
		$card = new Card($cardId, $cardCategoryId, $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION2);
		$card->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Card::getCardByCardCategoryId($this->getPDO(), $card->getCardCategoryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);

		// grab the result from the array and validate it
		$pdoCard = $results[0];
		$this->assertEquals($pdoCard->getCardId(), $this->category->getCardId());
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->card->getCardCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->card->getCardAnswer());
		$this->assertEquals($pdoCard->getCardPoints(), $this->card->getCardPoints());
		$this->assertEquals($pdoCard->getCardQuestion(), $this->card->getCardQuestion());

	}

	/**
	 * test grabbing a Card by cardCategoryId that does not exist
	 **/
	public function testGetInvalidCardByCardCategoryId() : void {
		// grab a card id that does not exist
		$card = Card::getCardByCardCategoryId($this->getPDO(), generateUuidV4());
		$this->assertNull($card);
	}


	/**
	 * test inserting a Card and regrabbing it from mySQL
	 **/
	public function testGetValidCardByCardId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");

		// create a new Card and insert to into mySQL
		$cardId = generateUuidV4();
		$cardCategoryId = generateUuidV4();
		$card = new Card($cardId, $cardCategoryId, $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION2);
		$card->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Card::getCardByCardId($this->getPDO(), $card->getCardId());
		$this->assertEquals($results->getCardId(), $cardId);
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);

		// grab the result from the array and validate it
		$pdoCard = Card::getCardByCardId($this->getPDO(), $card->getCardId());
		$this->assertEquals($pdoCard->getCardId(), $cardId);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
		$this->assertEquals($pdoCard->getCardId(), $this->category->getCardId());
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->card->getCardCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->card->getCardAnswer());
		$this->assertEquals($pdoCard->getCardPoints(), $this->card->getCardPoints());
		$this->assertEquals($pdoCard->getCardQuestion(), $this->card->getCardQuestion());


	}

	/**
	 * test grabbing a Card that does not exist
	 **/
	public function testGetInvalidCardByCardId() : void {
		// grab a card id that does not exist
		$card = Card::getCardByCardId($this->getPDO(), generateUuidV4());
		$this->assertNull($card);
	}

	/**
	 * test inserting a Card and regrabbing it from mySQL
	 **/
	public function testGetValidCardByCardPoints() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("card");

		// create a new Card and insert to into mySQL


		$cardId = generateUuidV4();
		$cardCategoryId = generateUuidV4();
		$card = new Card($cardId, $cardCategoryId, $this->VALID_CARD_ANSWER, $this->VALID_CARD_POINTS, $this->VALID_CARD_QUESTION2);
		$card->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Card::getCardByCardPoints($this->getPDO(), $card->getCardPoints());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));

		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);
		// grab the result from the array and validate it


		$pdoCard = $results[0];
		$this->assertEquals($pdoCard->getCardId(), $this->category->getCardId());
		$this->assertEquals($pdoCard->getCardCategoryId(), $this->card->getCardCategoryId());
		$this->assertEquals($pdoCard->getCardAnswer(), $this->card->getCardAnswer());
		$this->assertEquals($pdoCard->getCardPoints(), $this->card->getCardPoints());
		$this->assertEquals($pdoCard->getCardQuestion(), $this->card->getCardQuestion());

	}

	/**
	 * test grabbing a Card by points that does not exist
	 **/
	public function testGetInvalidCardByCardPoints() : void {
		// grab a card id that does not exist
		$card = Card::getCardByCardPoints($this->getPDO(), generateUuidV4());
		$this->assertNull($card);
	}












}