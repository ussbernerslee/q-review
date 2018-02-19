<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

//grab the MySQL connection
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/deepDiveOauth.ini");
$config = readConfig("/etc/apache2/capstone-mysql/kmaru.ini");
$pubnub= json_decode($config["pubnub"]);

$pubnubConfig = new \OAuth2\Client($oauth->clientId, $oauth->clientKey);
$pubNub = new PubNub($pubNubConfig);

