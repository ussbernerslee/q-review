<?php
namespace Edu\Cnm\Kmaru;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use PubNub\PubNub;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\Enums\PNStatusCategory;
use PubNub\Exceptions\PubNubUnsubscribeException;

class BoardSubscriber extends SubscribeCallback {
	/**
	 * board that is subscribing
	 * @var Board $board
	 **/
	protected $board;

	/**
	 * PubNub configuration object
	 * @var PubNub $pubNub
	 *
	 **/
	protected $pubNub;

	public function __construct(Board $newBoard, PubNub $newPubNub) {
		$this->board = $newBoard;
		$this->pubNub = $newPubNub;
	}

	public function message($pubnub, $message): void {
// method unnecessary
	}

	public function presence($pubnub, $presence): void {
// method unnecessary
	}

	public function status($pubnub, $status): void {
		if($status->getCategory() === PNStatusCategory::PNConnectedCategory) {
			$this->pubNub->publish()->channel("kmaru-" . $this->board->getBoardId())->message("tbennett19 will win")->sync();
			throw(new PubNubUnsubscribeException("unsubscribing after publishing"));
		}
	}
}