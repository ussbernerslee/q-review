<?php


class Ledger implements \JsonSerializable {

	/**
	 * id for the board on this ledger: this is a foreign key
	 * @var Uuid $ledgerBoardId
	 **/
	private $ledgerBoardId;

	/**
	 * id for the card on this ledger: this is a foreign key
	 * @var Uuid $ledgerCardId
	 **/
	private $ledgerCardId;


	/**
	 * id for the Profile on this ledger: this is a foreign key
	 * @var Uuid $ledgerProfileId
	 **/
	private $ledgerProfileId;







	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["ledgerBoardId"] = $this->ledgerBoardId->toString();
		$fields["ledgerCardId"] = $this->ledgerCardId->toString();
		$fields["ledgerProfileId"] = $this->ledgerProfileId->toString();
		return ($fields);
	}
}