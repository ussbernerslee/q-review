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
 */
//verify the session status. start session if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();