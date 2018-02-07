<?php
namespace Edu\Cnm\Kmaru\Test;

use Edu\Cnm\Kmaru\{Profile, Category};

//grab the class under scrutiny: Board
require_once(dirname(__DIR__) . "/autoload.php");

//grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit text for the Category class. It is complete
 * because *ALL* mySQL/PDO enabled methods are tested for both
 * invalid and valid inputs.
 *
 * @see Board
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 **/
class CategoryTest extends KmaruTest {
	/**
	 * Profile that created the Category; this is for foreign key relations
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
	 * @var string $VALID_CATEGORYNAME
	 **/
	protected $VALID_CATEGORYNAME = "PHPUnit test passing";

	/**
	 * name of the updated Category
	 * @var string $VALID_CATEGORYNAME2
	 **/
	protected $VALID_CATEGORYNAME2 = "PHPUnit test still passing";

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
	 * test inserting a valid Category and verify that the actual mySQL data matches
	 **/
	public function testInsertValidCategory() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("category");


		// create a new Category and insert to into mySQL
		$categoryId = generateUuidV4();
		$category = new Category($categoryId, $this->profile->getProfileId(), $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCategory = Category::getCategoryByCategoryId($this->getPDO(), $category->getCategoryId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("category"));
		$this->assertEquals($pdoCategory->getCategoryId(), $categoryId);
		$this->assertEquals($pdoCategory->getCategoryProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME);
	}
	/**
	 * test inserting a Category, editing it, and then updating it
	 **/
	public function testUpdateValidCategory() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("category");

		//create a new Board and insert into mySQL
		$categoryId = generateUuidV4();
		$category = new Board($categoryId, $this->profile->getProfileId(), $this->VALID_CATEGORYNAME, $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		//edit the Category and update it in mySQL
		$category->setCategoryName($this->VALID_CATEGORYNAME2);
		$category->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCategory = Category::getCategoryByCategoryId($this->getPDO(), $category->getCategoryId());
		$this->asssertEquals($pdoCategory->getCategoryId(), $categoryId);
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("category"));
		$this->assertEquals($pdoCategory->getCategoryProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME2);
	}

	/**
	 * test creating a Category and then deleting it
	 **/
	public function testDeleteValidCategory() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("category");

		//create a new Category and insert it into mySQL
		$categoryId = generateUuidV4();
		$category = new Category($categoryId, $this->profile->getProfileId(), $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		//delete the Category from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("category"));
		$this->delete($this->getPDO());

		//grab the data from mySQL and enforce the Category does not exist
		$pdoCategory = Category::getCategoryByCategoryId($this->getPDO(), $category->getCategoryId());
		$this->assertNull($pdoCategory);
		$this->asserEquals($numRows, $this->getConnection()->getRowCount("category"));
	}

	/**
	 * test grabbing a Category that does not exist
	 **/
	public function testGetInvalidCategoryByCategoryId() : void {
		//grab a category id that exceeds the maximum allowable category id
		$category = Category::getCategoryByCategoryId($this->getPDO(), generateUuidV4());
		$this->assertNull($category);
	}

	/**
	 * test inserting a Category and re-grabbing it from mySQL
	 **/
	public function testGetValidCategoryByCategoryProfileId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()>getRowCount("category");

		//create a new Category and insert it in to mySQL
		$categoryId = generateUuidV4();
		$category = new Category($categoryId, $this->profile->getProfileId(), $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Category::getCatetegoryByCategoryProfileId($this->getPDO(), $category->getCategoryProfileId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("category"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Category", $results);

		//grab the result from the array and validate it
		$pdoCategory = $results[0];

		$this->assertEquals($pdoCategory->getCategoryId(), $categoryId);
		$this->assertEquals($pdoCategory->getCategoryProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME);
	}

	/**
	 * test grabbing a Category that does not exist
	 **/
	public function testGetInvalidCategoryByCategoryProfileId(): void {
		// grab a profile id that exceeds the maximum allowable profile id
		$category = Category::getCatetegoryByCategoryProfileId($this->getPDO(), generateUuidV4());
		$this->assertCount(0, $category);
	}

	/**
	 * test grabbing a Category by category name
	 **/
	public function testGetValidCategoryByCategoryName() : void {
		//count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("category");

		//create a new Category and insert it into mySQL
		$categoryId = generateUuidV4();
		$category = new Category($categoryId, $this->profile->getProfileId(), $this->VALID_CATEGORYNAME);
		$category->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Category::getCategoryByCategoryName($this->getPDO(), $category->getCategoryName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("category"));
		$this->assertCount(1, $results);

		//enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Category", $results);

		//grab the result from the array and validate it
		$pdoCategory = $results[0];
		$this->assertEquals($pdoCateogry->getCategoryId(), $categoryId);
		$this->assertEquals($pdoCategory->getBCategoryProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME);
	}

	/**
	 * test grabbing a Category by name that does not exist
	 **/
	public function testGetInvalidCategoryByCategoryName() : void {
		//grab a category by name that does not exist
		$category = Category::getCategoryByCategoryName($this->getPDO(), "Who is in the brig today?");
		$this->assertCount(0, $category);
	}

	/**
	 * test grabbing all Categories
	 **/
	public function testGetAllValidCategories(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("category");

		//create a new Category and insert it into mySQL
		$categoryId = generateUuidV4();
		$category = new Category($categoryId, $this->profile->getProfileId(), $this->VALID_BOARDNAME);
		$category->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Category::getAllCategories($this->getPDO());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("category"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Kmaru\\Category", $results);

		//grab the result from the array and validate it
		$pdoCategory = $results[0];
		$this->assertEquals($pdoCategory->getCategoryId(), $categoryId);
		$this->assertEquals($pdoCategory->getCategoryProfileId(), $this->profile->getprofileId());
		$this->assertEquals($pdoCategory->getCategoryName(), $this->VALID_CATEGORYNAME);
	}


}


?>