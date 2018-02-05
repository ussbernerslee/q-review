<?php
namespace Edu\Cnm\DataDesign;



require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Category
 *
 *
 *
 * @author Kenneth Keyes kkeyes1@cnm.edu updated for /~kkeyes1/data-design
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/
class Category implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this category: primary key
	 * @var Uuid $categoryId
	 **/
	private $categoryId;
	/**
	 * profile for this category by profile id: foreign key
	 * @var Uuid $categoryProfileId
	 **/
	private $categoryProfileId;
	/**
	 * name for this category: unique index
	 * @var string $categoryName
	 **/
	private $categoryName;

	/**
	 * constructor for new category
	 *
	 * @param string|Uuid $newCategoryId
	 * @param string|Uuid $newCategoryProfileId
	 * @param string $newCategoryName
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newCategoryId, $newCategoryProfileId, string $newCategoryName) {
		try {
			$this->setCategoryId($newCategoryId);
			$this->setCategoryProfileId($newCategoryProfileId);
			$this->setCategoryName($newCategoryName);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for getting categoryId
	 *
	 * @return Uuid value for categoryId (or null if new category)
	 **/
	public function getCategoryId(): Uuid {
		return ($this->categoryId);
	}
	/**
	 * mutator function for categoryId
	 *
	 * @param Uuid|string $newCategoryId with the value of categoryId
	 * @throws \RangeException if $newCategoryId is not positive
	 * @throws \TypeError if category id is not positive
	 **/
	public function setCategoryId($newCategoryId): void {
		try {
			$uuid = self::validateUuid($newCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the category id
		$this->categoryId = $uuid;
	}
	/**
	 * accessor method for getting categoryProfileId
	 *
	 * @return Uuid value for categoryProfileId
	 **/
	public function getCategoryProfileId(): Uuid {
		return ($this->categoryProfileId);
	}
	/**
	 * mutator function for categoryProfileId
	 *
	 * @param Uuid|string $newCategoryProfileId with the value of categoryProfileId
	 * @throws \RangeException if $newCategoryProfileId is not positive
	 * @throws \TypeError if category profile id is not positive
	 **/
	public function setCategoryProfileId($newCategoryProfileId): void {
		try {
			$uuid = self::validateUuid($newCategoryProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the category profile id
		$this->categoryProfileId = $uuid;
	}
	/**
	 * accessor method for getting categoryName
	 *
	 * @return string value for categoryName
	 **/
	public function getCategoryName(): string {
		return ($this->categoryName);
	}
	/**
	 * mutator method for category name
	 *
	 * @param string $newCategoryName new value of category name
	 * @throws \InvalidArgumentException if $newCategoryName is not a string or insecure
	 * @throws \RangeException if $newCategoryName is > 64 characters
	 * @throws \TypeError if $newCategoryName is not a string
	 **/
	public function setCategoryName(string $newCategoryName): void {
		// verify the category name is secure
		$newCategoryName = trim($newCategoryName);
		$newCategoryName = filter_var($newCategoryName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCategoryName) === true) {
			throw(new \InvalidArgumentException("category name is empty or insecure"));
		}
		// verify the category name will fit in the database
		if(strlen($newCategoryName) > 64) {
			throw(new \RangeException("category name is too large"));
		}
		// store the board name
		$this->categoryName = $newCategoryName;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["categoryId"] = $this->categoryId;
		$fields["categoryProfileId"] = $this->categoryProfileId;
		return ($fields);
	}

}