<?php
namespace Edu\Cnm\DataDesign;



require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Card
 *
 *
 *
 * @author Kenneth Keyes kkeyes1@cnm.edu updated for /~kkeyes1/data-design
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/
class Card {

	private $cardId;

	private $cardCategoryId;

	private $cardAnswer;

	private $cardPoints;

	private $cardQuestion;

	public function __construct($newCardId, $newCardCategoryId, $newCardAnswer, $newCardPoints, $newCardQuestion) {
		try {
			$this->setCardId($newCardId);
			$this->setCardCategoryId($newCardCategoryId);
			$this->setCardAnswer($newCardAnswer);
			$this->setCardPoints($newCardPoints);
			$this->setCardQuestion($newCardQuestion);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for getting cardId
	 *
	 * @return Uuid value for cardId
	 **/
	public function getCardId(): Uuid {
		return ($this->cardId);
	}
	/**
	 * mutator function for cardId
	 *
	 * @param Uuid|string $newCardId with the value of cardId
	 * @throws \RangeException if $newCardId is not positive
	 * @throws \TypeError if card id is not positive
	 **/
	public function setCardId($newCardId): void {
		try {
			$uuid = self::validateUuid($newCardId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the card id
		$this->cardId = $uuid;
	}
	/**
	 * accessor method for getting cardCategoryId
	 *
	 * @return Uuid value for cardCategoryId
	 **/
	public function getCardCategoryId(): Uuid {
		return ($this->cardCategoryId);
	}
	/**
	 * mutator function for cardCategoryId
	 *
	 * @param Uuid|string $newCardCategoryId with the value of cardCategoryId
	 * @throws \RangeException if $newCardCategoryId is not positive
	 * @throws \TypeError if card category id is not positive
	 **/
	public function setCardId($newCardCategoryId): void {
		try {
			$uuid = self::validateUuid($newCardCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the card category id
		$this->cardCategoryId = $uuid;
	}
	/**
	 * accessor method for getting cardAnswer
	 *
	 * @return string value for cardAnswer
	 **/
	public function getCardAnswer(): string {
		return ($this->cardAnswer);
	}
	/**
	 * accessor method for getting cardPoints
	 *
	 * @return string value for cardPoints
	 **/
	public function getCardPoints(): string {
		return ($this->cardPoints);
	}
	/**
	 * accessor method for getting cardQuestion
	 *
	 * @return string value for cardQuestion
	 **/
	public function getCardQuestion(): string {
		return ($this->cardQuestion);
	}


}