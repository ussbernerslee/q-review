<?php

use Edu\Cnm\Kmaru\{Profile, Category, Card, Board, Ledger};

require_once(dirname(__DIR__) . "/classes/autoload.php");

require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

require_once("uuid.php");

$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/kmaru.ini");


// create a salt and hash for the mocked captain profile
$passwordCaptain = "poodledoodle2";
$VALID_SALT_CAPTAIN = bin2hex(random_bytes(32));
$VALID_HASH_CAPTAIN = hash_pbkdf2("sha512", $passwordCaptain, $VALID_SALT_CAPTAIN, 262144);
$VALID_ACTIVATION_CAPTAIN = bin2hex(random_bytes(16));

//create and insert a Profile to create the category, card, and board
$profileCaptain = new Profile(generateUuidV4(), null, "jcrew@cnm.edu", $VALID_HASH_CAPTAIN, "Captain Jean-Luc Picard", 123, $VALID_SALT_CAPTAIN, "jcrew");
$profileCaptain->insert($pdo);
echo "captain profile";
var_dump($profileCaptain->getProfileId()->toString());



// player profile 1
$password = "resistance";
$SALT = bin2hex(random_bytes(32));
$HASH = hash_pbkdf2("sha512", $password, $SALT, 262144);
$VALID_ACTIVATION = bin2hex(random_bytes(16));

//create and insert a Profile to play the game and answer questions
$profile1 = new Profile(generateUuidV4(), null, "anna@cnm.edu", $HASH, "Anna", 0, $SALT, "host");
$profile1->insert($pdo);
echo "player1 profile";
var_dump($profile1->getProfileId()->toString());




// player profile2
$password = "isFutile";
$SALT = bin2hex(random_bytes(32));
$HASH = hash_pbkdf2("sha512", $password, $SALT, 262144);
$VALID_ACTIVATION = bin2hex(random_bytes(16));

//create and insert a Profile to play the game and answer questions
$profile2 = new Profile(generateUuidV4(), null, "marty@cnm.edu", $HASH, "I know shit", 0, $SALT, "Mknows");
$profile2->insert($pdo);
echo "player2 profile";
var_dump($profile2->getProfileId()->toString());





// create and insert a Category to house the cards in the ledger
$category = new Category(generateUuidV4(), $profileCaptain->getProfileId(), "CSS");
$category->insert($pdo);
echo "category CSS";
var_dump($category->getCategoryId()->toString());





// create and insert a Card to be answered by the profile on the board for the ledger
$pointsOnCard1 = 200;
$card1 = new Card(generateUuidV4(), $category->getCategoryId(), "Read the Documentation!", $pointsOnCard1, "If you are unsure of what you are writing...what should you do next?");
$card1->insert($pdo);
echo "first card";
var_dump($card1->getCardId()->toString());



$pointsOnCard2 = 500;
$card2 = new Card(generateUuidV4(), $category->getCategoryId(), "No", $pointsOnCard1, "Do you know what your are doing?");
$card2->insert($pdo);
echo "second card";
var_dump($card2->getCardId()->toString());



// create and insert a Board to contain the cards contained in the ledger
$board = new Board(generateUuidV4(), $profileCaptain->getProfileId(), "Treking");
$board->insert($pdo);
echo "board";
var_dump($board->getBoardId()->toString());




// create new ledger for procedure to use
$ledger1 = new Ledger($board->getBoardId(), $card1->getCardId(), $profile1->getProfileId(), $pointsOnCard1, 3);
$ledger1->insert($pdo);
echo "first ledger";
var_dump($ledger1->getLedgerBoardId()->toString(), $ledger1->getLedgerCardId(), $ledger1->getLedgerProfileId());


$ledger2 = new Ledger($board->getBoardId(), $card2->getCardId(), $profile1->getProfileId(), -500, 2);
$ledger2->insert($pdo);
echo "second ledger";
var_dump($ledger2->getLedgerBoardId()->toString(), $ledger2->getLedgerCardId(), $ledger2->getLedgerProfileId());


$ledger3 = new Ledger($board->getBoardId(), $card2->getCardId(), $profile2->getProfileId(), $pointsOnCard2, 1);
$ledger3->insert($pdo);
echo "third ledger";
var_dump($ledger3->getLedgerBoardId()->toString(), $ledger3->getLedgerCardId(), $ledger3->getLedgerProfileId());



