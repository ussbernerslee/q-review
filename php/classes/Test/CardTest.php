<?php
namespace Edu\Cnm\KmaruTest\Test;
use Edu\Cnm\Kmaru\Test\KmaruTest;
use Edu\Cnm\KmaruTest\{Card};
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
	 * cardCategoryId that populates the Card; this is for foreign key relations
	 * @var  cardCategoryId $CardCategoryId
	 **/
	protected $CardCategoryId;
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
	 * valid activationToken to create the profile object to own the test
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
		// create a salt and hash for the mocked card
		$password = "abc123";
		$this->VALID_SALT = bin2hex(random_bytes(32));
		$this->VALID_HASH = hash_pbkdf2("sha512", $password, $this->VALID_SALT, 262144);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
		// create and insert the mocked card
		$this->category = new cardCategoryId(generateUuidV4(), null, "@phpunit", "test@phpunit.de", $this->VALID_HASH, "+12125551212", $this->VALID_SALT);
		$this->category->insert($this->getPDO());
		// create the card and insert the mocked card
		$this->card = new Card(generateUuidV4(), $this->category->getCardCategoryId(), "PHPUnit card test passing");
		$this->card->insert($this->getPDO());
		// calculate the date (just use the time the unit test was setup...)
		/**
		 * test inserting a valid Card and verify that the actual mySQL data matches
		 **/
		public
		function testInsertValidCard(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL
			$card = new Card($this->category->getCardCategoryId(), $this->card->getCardId(), $this->VALID_CARDDATE);
			$card->insert($this->getPDO());
			// grab the data from mySQL and enforce the fields match our expectations
			$pdoCard = Card::getCardByCardIdAndCardCategoryId($this->getPDO(), $this->category->getCardCategoryId(), $this->card->getCardId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
			$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCardCategoryId());
			$this->assertEquals($pdoCard->getCardId(), $this->card->getCardId());
			//format the date too seconds since the beginning of time to avoid round off error
			$this->assertEquals($pdoCard->getCardDate()->getTimeStamp(), $this->VALID_CARDDATE->getTimestamp());
		}

		/**
		 * test creating a Card and then deleting it
		 **/
		public
		function testDeleteValidCard(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL
			$card = new Card($this->category->getCardCategoryId(), $this->card->getCardId(), $this->VALID_CARDDATE);
			$card->insert($this->getPDO());
			// delete the Card from mySQL
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
			$card->delete($this->getPDO());
			// grab the data from mySQL and enforce the Card does not exist
			$pdoCard = Card::getCardByCardIdAndCardCategoryId($this->getPDO(), $this->category->getCardCategoryId(), $this->card->getCardId());
			$this->assertNull($pdoCard);
			$this->assertEquals($numRows, $this->getConnection()->getRowCount("card"));
		}

		/**
		 * test inserting a Card and regrabbing it from mySQL
		 **/
		public
		function testGetValidCardByCardIdAndCardCategoryId(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL
			$card = new Card($this->category->getCardCategoryId(), $this->card->getCardId(), $this->VALID_CARDDATE);
			$card->insert($this->getPDO());
			// grab the data from mySQL and enforce the fields match our expectations
			$pdoCard = Card::getCardByCardIdAndCardCategoryId($this->getPDO(), $this->category->getCategoryId(), $this->card->getCardId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
			$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCardCategoryId());
			$this->assertEquals($pdoCard->getCardCardId(), $this->card->getCardId());
			//format the date too seconds since the beginning of time to avoid round off error//}
		}

		/**
		 * test grabbing a Card that does not exist
		 **/
		public
		function testGetInvalidCardByCardIdAndCardCategoryId() {
			// grab a card id and card category id that exceeds the maximum allowable card id and category id
			$card = Card::getCardByCardIdAndCardCardCategoryId($this->getPDO(), generateUuidV4(), generateUuidV4());
			$this->assertNull($card);
		}

		/**
		 * test grabbing a Card by card id
		 **/
		public
		function testGetValidCardByCardId(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL
			$Card = new Card($this->category->getCardCategoryId(), $this->card->getCardId(), $this->VALID_CARDDATE);
			$Card->insert($this->getPDO());
			// grab the data from mySQL and enforce the fields match our expectations
			$results = Card::getCardByCardId($this->getPDO(), $this->Card->getCardId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
			$this->assertCount(1, $results);
			$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);
			// grab the result from the array and validate it
			$pdoCard = $results[0];
			$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCardCategoryId());
			$this->assertEquals($pdoCard->getCardId(), $this->card->getCardId());
			//format the date too seconds since the beginning of time to avoid round off error
			$this->assertEquals($pdoCard->getCardDate()->getTimeStamp(), $this->VALID_CARDDATE->getTimestamp());
		}

		/**
		 * test grabbing a Card by a card id that does not exist
		 **/
		public
		function testGetInvalidCardByCardId(): void {
			// grab a card id that exceeds the maximum allowable card id
			$card = Card::getCardByCardId($this->getPDO(), generateUuidV4());
			$this->assertCount(0, $card);
		}

		/**
		 * test grabbing a Card by cardCategory id
		 **/
		public
		function testGetValidCardByCardCategoryId(): void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("card");
			// create a new Card and insert to into mySQL
			$card = new Card($this->category->getCardCategoryId(), $this->card->getCardId(), $this->VALID_LIKEDATE);
			$card->insert($this->getPDO());
			// grab the data from mySQL and enforce the fields match our expectations
			$results = Card::getCardByCardCategoryId($this->getPDO(), $this->category->getCardCategoryId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("card"));
			$this->assertCount(1, $results);
			// enforce no other objects are bleeding into the test
			$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Card", $results);
			// grab the result from the array and validate it
			$pdoCard = $results[0];
			$this->assertEquals($pdoCard->getCardCategoryId(), $this->category->getCardCategoryId());
			$this->assertEquals($pdoCard->getCardCategoryId(), $this->card->getCardId());
			//format the date too seconds since the beginning of time to avoid round off error
		}
	}

		/**
		 * test grabbing a Card by a cardCategory id that does not exist
		 **/
		public
		function testGetInvalidCardByCardCategoryId(): void {
			// grab a card by cardCategoryId that exceeds the maximum allowable cardCategoryId
			$card = Card::getCardByCardCategoryId($this->getPDO(), generateUuidV4());
			$this->assertCount(0, $card);
		}
	}
}