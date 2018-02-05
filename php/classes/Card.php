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
class Card implements \JsonSerializable {
	use ValidateUuid;

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
	 * mutator method for card answer
	 *
	 * @param string $newCardAnswer new value of card answer
	 * @throws \InvalidArgumentException if $enwCardAnswer is not a string or insecure
	 * @throws \RangeException if $newCardAnswer is > 255 characters
	 * @throws \TypeError if $newCardAnswer is not a string
	 **/
	public function setCardAnswer(string $newCardAnswer): void {
		// verify the card answer is secure
		$newCardAnswer = trim($newCardAnswer);
		$newCardAnswer = filter_var($newCardAnswer, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCardAnswer) === true) {
			throw(new \InvalidArgumentException("card answer is empty or insecure"));
		}
		// verify the card answer will fit in the database
		if(strlen($newCardAnswer) > 255) {
			throw(new \RangeException("card answer content too large"));
		}
		// store the card answer
		$this->cardAnswer = $newCardAnswer;
	}
	/**
	 * accessor method for getting cardPoints
	 *
	 * @return string value for cardPoints
	 **/
	public function getCardPoints(): int {
		return ($this->cardPoints);
	}
	/**
	 * mutator method for card points
	 *
	 * @param int $newCardPoints new value of card points
	 * @throws \InvalidArgumentException if $newCardPoints is not an int or insecure
	 * @throws \RangeException if $newCardPoints is > 10 characters
	 * @throws \TypeError if $newCardPoints is not an int
	 **/
	public function setCardPoints(int $newCardPoints): void {
		// verify the card points are secure
		$newCardPoints = trim($newCardPoints);
		$newCardPoints = filter_var($newCardPoints, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCardPoints) === true) {
			throw(new \InvalidArgumentException("card points are empty or insecure"));
		}
		// verify the card points will fit in the database
		if(strlen($newCardPoints) > 10) {
			throw(new \RangeException("card points is too large"));
		}
		// store the card points
		$this->cardPoints = $newCardPoints;
	}
	/**
	 * accessor method for getting cardQuestion
	 *
	 * @return string value for cardQuestion
	 **/
	public function getCardQuestion(): string {
		return ($this->cardQuestion);
	}
	/**
	 * mutator method for card question
	 *
	 * @param string $newCardQuestion new value of card answer
	 * @throws \InvalidArgumentException if $enwCardQuestion is not a string or insecure
	 * @throws \RangeException if $newCardQuestion is > 255 characters
	 * @throws \TypeError if $newCardQuestion is not a string
	 **/
	public function setCardQuestion(string $newCardQuestion): void {
		// verify the card question is secure
		$newCardQuestion = trim($newCardQuestion);
		$newCardQuestion = filter_var($newCardQuestion, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCardQuestion) === true) {
			throw(new \InvalidArgumentException("card question is empty or insecure"));
		}
		// verify the card question will fit in the database
		if(strlen($newCardQuestion) > 255) {
			throw(new \RangeException("card question content too large"));
		}
		// store the card question
		$this->cardQuestion = $newCardQuestion;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["cardId"] = $this->cardId;
		$fields["cardCategoryId"] = $this->cardCategoryId;
		return ($fields);
	}


}