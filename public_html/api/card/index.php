<?php
require_once dirname(__DIR__,3) . "/vendor/autoload.php";
require_once dirname(__DIR__,3) . "/php/classes/autoload.php";
require_once dirname(__DIR__,3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once dirname(__DIR__, 3) . "/php/lib/jwt.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Kmaru\{
	Card,
	// use the Category class for testing only
	Category
};

/**
 * api for the Card class
 *
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 * @author George Kephart <>
 */
//verify the session status. start session if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// grab the mySQL connection
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/Kmaru.ini");

	// determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardCategoryId = filter_input(INPUT_GET, "cardCategoryId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardAnswer = filter_input(INPUT_GET, "cardAnswer", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardPoints = filter_input(INPUT_GET, "cardPoints", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardQuestion = filter_input(INPUT_GET, "cardQuestion", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	// handle GET request - if id is present, that card is returned, otherwise all cards are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific card or all cards and update reply
		if(empty($id) === false) {
			$card = Card::getCardByCardId($pdo, $id);
			if($card !== null) {
				$reply->data = $card;
			}
		} else if(empty($cardCategoryId) === false) {
			$card = Card::getCardByCardCategoryId($pdo, $cardCategoryId)->toArray();
			if($card !== null) {
				$reply->data = $tweet;
			}
		} else if(empty($cardAnswer) === false) {
			$cards = Card::getCardByCardAnswer($pdo, $cardAnswer)->toArray();
			if($cards !== null) {
				$reply->data = $cards;
			}
		} else if(empty($cardPoints) === false) {
			$cards = Card::getCardByCardPoints($pdo, $cardPoints)->toArray();
			if($cards !== null) {
				$reply->data = $cards;
			}
		} else if(empty($cardQuestion) === false) {
			$cards = Card::getCardByCardQuestion($pdo, $cardQuestion)->toArray();
			if($cards !== null) {
				$reply->data = $cards;
			}
		} else {
			$cards = Card::getAllCards($pdo)->toArray();
			if($cards !== null) {
				$reply->data = $cards;
			}
		}

	} else if($method === "PUT" || $method === "POST") {

		//enforce the user is signed in
		if(empty($_SESSION["category"]) === true) {
			throw(new \InvalidArgumentException("you must be logged in to write a card", 401));
		}
	}
}
