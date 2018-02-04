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
class Category {

	private $categoryId;

	private $categoryProfileId;

	private $categoryName;

	/**
	 * constructor for new category
	 *
	 * @param string|Uuid $newCategoryId
	 * @param string $newCategoryProfileId
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
	 * accessor method for getting categoryProfileId
	 *
	 * @return Uuid value for categoryProfileId
	 **/
	public function getCategoryProfileId(): Uuid {
		return ($this->categoryProfileId);
	}
	/**
	 * accessor method for getting categoryName
	 *
	 * @return string value for categoryName
	 **/
	public function getCategoryName(): string {
		return ($this->categoryName);
	}

}