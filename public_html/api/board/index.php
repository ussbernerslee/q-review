<?php
require_once(dirname(__DIR__, 3) . "/vendor/autoload.php");
require_once(dirname(__DIR__, 3) . "/php/classes/autoload.php");
require_once(dirname(__DIR__, 3) . "/php/lib/jwt.php");
require_once(dirname(__DIR__, 3) . "/php/lib/xsrf.php");
require_once(dirname(__DIR__, 3) . "/php/lib/uuid.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Kmaru\{Board};
use PubNub\PNConfiguration;
use PubNub\PubNub;


//TODO: decode sucks
/**
 * Accessing pubnub for the Board
 **/
$config = readConfig("/etc/apache2/capstone-mysql/kmaru.ini");
$pubNub = json_decode($config["pubnub"]);

$pubNubConf = new PNConfiguration();

$pubNubConf->setSubscribeKey("$pubNub->subscribeKey");
$pubNubConf->setPublishKey("$pubNub->publishKey");
$pubNubConf->setSecretKey("$pubNub->secretKey");
$pubNubConf->setSecure(true);

$pubNubBoard = new PubNub($pubNubConf);



/**
 * API for the Board
 *
 * @author Tristan Bennett tbennett19@cnm.edu
 */
//verify the session, if it is not active start it
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/kmaru.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//sanitize input; id is boardId
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$boardProfileId = filter_input(INPUT_GET, "boardProfileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	//can be empty
	$boardName = filter_input(INPUT_GET, "boardName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//TODO: this is always empty or invalid...FAIL
	// make sure the id is valid
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("Id cannot be empty or invalid, 400"));
	}

	// handle get request. If id is valid, return name of board and creator
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//gets a board by boardId
		if(empty($id) === false) {
			$board = Board::getBoardbyBoardId($pdo, $id);
			if($board !== null) {
				$reply->data = $board;
			}
			// else gets the board by the profile that crated it
		} else if(empty($boardProfileId) === false) {
			$boardProfileId = Board::getBoardByBoardProfileId($pdo, $boardProfileId);
			if($boardProfileId !== null) {
				$reply->data = $boardProfileId;
			}

		}
	} else if($method === "POST") {
			//enforce that the XSRF token is present in the header
			verifyXsrf();
			//enforce the end user has a JWT token
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//checking creator of board
		if(empty($requestObject->boardName) === true) {
			throw(new \InvalidArgumentException ("No board profile", 400));
		}

			if(empty($_SESSION["profile"] === true)) {
				throw(new \InvalidArgumentException("You are not allowed to access this board", 400));
			}

			$board = new Board(generateUuidV4(), $_SESSION["profile"]->getProfileId(), $requestObject->boardName);
			//enforce the user is signed in and only trying to edit their own board
//			if(empty($_SESSION["board"]) === true || $_SESSION["board"]->getBoardId()->toString() !== $id) {
//				throw(new \InvalidArgumentException("You are not allowed to access this board", 400));
//			}
			$_SESSION["boardId"] = $board->getBoardId();
			// creating channel for board
			$pubNubBoard->addChannelToChannelGroup()
				->channels($_SESSION["boardId"])
				->channelGroup("ddc")
				->sync();

			$reply->message = "Board Created" . $id;


	} elseif($method === "DELETE") {
		//verify the XSRF Token
		verifyXsrf();

		//enforce the end user has a JWT token
		validateJwtHeader();
		$board = Board::getBoardByBoardId($pdo, $id);
		if($board === null) {
			throw(new RuntimeException("Board does not exist"));
		}
		//enforce the user is signed in and only trying to edit their own board
		if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId()->toString() !== $board->getBoardProfileId()->toString()) {
			throw(new \InvalidArgumentException("You are not allowed to access this Board", 400));
		}

		validateJwtHeader();
		//delete the board from the database
		$board->delete($pdo);
		$reply->message = "Board Deleted";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP request", 400));
	}
	// catch any exceptions that were thrown and update the status and message state variable fields
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);
