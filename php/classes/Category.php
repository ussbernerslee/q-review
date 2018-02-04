<?php

/*
CREATE TABLE category(
-- attribute for primary key:
	categoryId BINARY(16) NOT NULL,
	-- attribute for foreign key:
	categoryProfileId BINARY(16) NOT NULL,
	-- attributes for category;
	categoryName VARCHAR(64) NOT NULL,
	-- unique index created:
	UNIQUE (categoryId),
	-- create foreign keys and relationships:
	FOREIGN KEY (categoryProfileId) REFERENCES profile(profileId),
	-- Primary key:
	PRIMARY KEY(categoryId)
);
*/

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