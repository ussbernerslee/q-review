<?php
require_once dirname(__DIR__,3) . "/vendor/autoload.php";
require_once dirname(__DIR__,3) . "/php/classes/autoload.php";
require_once dirname(__DIR__,3) . "/php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Kmaru\{
	Card,
	// use the profile class for testing only
	Profile
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

try{
	// grab the mySQL connection
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/Kmaru.ini");

	// determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardCategoryId = filter_input(INPUT_GET, "cardCategoryId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardAnswer = filter_input(INPUT_GET, "cardAnswer",FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardPoints = filter_input(INPUT_GET, "cardPoints", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$cardQuestion = filter_input(INPUT_GET, "cardQuestion", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

}