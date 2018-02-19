<?php
require_once(dirname(__DIR__, 3) . "/vendor/autoload.php");
require_once(dirname(__DIR__, 3) . "/php/classes/autoload.php");
require_once(dirname(__DIR__, 3) . "/php/lib/jwt.php");
require_once(dirname(__DIR__, 3) . "/php/lib/xsrf.php");
require_once(dirname(__DIR__, 3) . "/php/lib/uuid.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Kmaru\ {};

/**
 * API for the Board
 *
 * @author Tristan Bennett tbennett19@cnm.edu
 */
//verify the session, if it is not active start it
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//verify the session, start if not active
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

	//sanitize input

	//id reffering to boardId
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$boardProfileId = filter_input(INPUT_GET, "boardProfileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$boardName = filter_input(INPUT_GET, "boardName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// make sure the id is valid
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative, 400"));
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
		} else if(empty($boardProfileId) === false) {
			$boardProfileId = Board::getBoardByBoardProfileId($pdo, $boardProfileId);
			if($boardProfileId !== null) {
				$reply->data = $boardProfileId;
			}
		} else if(empty($boardName) === false) {
			$boardName = Board::getBoardByBoardName($pdo, $boardName);
			if($boardName !== null) {
				$reply->data = $boardName;
			}
		} else if($method === "PUT") {
			//enforce that the XSRF token is present in the header
			verifyXsrf();
			//enforce the end user has a JWT token
			//validateJwtHeader();
			//enforce the user is signed in and only trying to edit their own board
			if(empty($_SESSION["board"]) === true || $_SESSION["board"]->getBoardId()->toString() !== $id) {
				throw(new \InvalidArgumentException("You are not allowed to access this board", 400));
			}
		}
		validateJwtHeader();
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		//retrieve the board to be updated
		$board = Board::getBoardByBoardId($pdo, $id);
		if($board === null) {
			throw(new RuntimeException("Board does not exist", 400));
		}
		//board profile id
		if(empty($requestObject->boardProfileId) === true) {
			throw(new \InvalidArgumentException ("No board profile", 400));
		}
		//board name
		if(empty($requestObject->boardName) === true) {
			throw(new \InvalidArgumentException ("No board name present", 400));
		}
		$board->setBoardProfileId($requestObject->categoryProfileId);
		$board->setBoardName($requestObject->categoryName);
		$board->update($pdo);

		// update reply
		$reply->message = "Board information updated";
	} elseif($method === "DELETE") {
		//verify the XSRF Token
		verifyXsrf();

		//enforce the end user has a JWT token
		//validateJwtHeader();
		$board = Board::getBoardByBoardId($pdo, $id);
		if($board === null) {
			throw (new RuntimeException("Board does not exist"));
		}
		//enforce the user is signed in and only trying to edit their own board
		if(empty($_SESSION["board"]) === true || $_SESSION["board"]->getBoardId()->toString() !== $board->getBoardId()->toString()) {
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
