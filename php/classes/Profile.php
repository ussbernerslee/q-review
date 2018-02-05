<?php
namespace Edu\Cnm\DataDesign;



require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Profile
 *
 * This is what data is stored when a user creates a profile.
 * This is top-level entity, categories, boards, cards and ledgers cannot exist without a profile
 *
 * @author Kenneth Keyes kkeyes1@cnm.edu updated for /~kkeyes1/data-design
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/

class Profile implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this profile: primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * token handed out to verify that account is not malicious
	 * @var string $profileActivationToken
	 **/
	private $profileActivationToken;
	/**
	 * email associated with this profile; this is a unique index
	 * @var string $profileEmail
	 **/
	private $profileEmail;
	/**
	 * hash for profile password
	 * @var string $profileHash
	 **/
	private $profileHash;
	/**
	 * this is the name associated with this account
	 * @var string $profileName
	 **/
	private $profileName;
	/**
	 * user role privilege - Captain or Student
	 * @var string $profilePrivilege
	 **/
	private $profilePrivilege;
	/**
	 * salt stored for this profile
	 * @var string $profileSalt
	 **/
	private $profileSalt;
	/**
	 * username for this profile; this is a unique index
	 * @var string $profileUsername
	 **/
	private $profileUsername;

	/**
	 * constructor for this Profile
	 *
	 * @param string|Uuid $newProfileId id of this Profile or null if a new Profile
	 * @param string $newProfileActivationToken activation token to safe guard against malicious accounts
	 * @param string $newProfileEmail string containing email
	 * @param string $newProfileHash string containing password hash
	 * @param string $newProfileName string containing new profile name
	 * @param string $newProfilePrivilege string containing new profile privilege: captain or student
	 * @param string $newProfileSalt string containing password salt
	 * @param string $newProfileUsername string containing username
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, ?string $newProfileActivationToken, string $newProfileEmail, string $newProfileHash, string $newProfileName, string $newProfilePrivilege, string $newProfileSalt, string $newProfileUsername) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileName($newProfileName);
			$this->setProfilePrivilege($newProfilePrivilege);
			$this->setProfileSalt($newProfileSalt);
			$this->setProfileUsername($newProfileUsername);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for getting profileId
	 *
	 * @return Uuid value for profileId (or null if new profile)
	 **/
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}
	/**
	 * mutator function for profileId
	 *
	 * @param Uuid|string $newProfileId with the value of profileId
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if profile id is not positive
	 **/
	public function setProfileId($newProfileId): void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;
	}
	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 **/
	public function getProfileActivationToken(): ?string {
		return ($this->profileActivationToken);
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param string $newProfileActivationToken
	 * @throws \InvalidArgumentException if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 **/
	public function setProfileActivationToken(?string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->profileActivationToken = $newProfileActivationToken;
	}
	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newProfileEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		// store the email
		$this->profileEmail = $newProfileEmail;
	}
	/**
	 * accessor method for profileHash
	 *
	 * @return string value of hash
	 **/
	public function getProfileHash(): string {
		return $this->profileHash;
	}
	/**
	 * mutator method for profile hash password
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/
	public function setProfileHash(string $newProfileHash): void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 128 characters.
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 * accessor method for name
	 *
	 * @return string value of name
	 **/
	public function getProfileName(): string {
		return ($this->profileName);
	}
	/**
	 * mutator method for name
	 *
	 * @param string $newProfileName new value of name
	 * @throws \InvalidArgumentException if $newProfileName is not a string or insecure
	 * @throws \RangeException if $newProfileName is > 50 characters
	 * @throws \TypeError if $newProfileName is not a string
	 **/
	public function setProfileName(string $newProfileName): void {
		// verify the name is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("name is empty or insecure"));
		}
		// verify the name will fit in the database
		if(strlen($newProfileName) > 50) {
			throw(new \RangeException("name is too large"));
		}
		// store the full name
		$this->profileName = $newProfileName;
	}
	/**
	 * accessor method for profile privilege
	 *
	 * @return string value of profile privilege
	 **/
	public function getProfilePrivilege(): string {
		return($this->profilePrivilege);
	}
	/**
	 * mutator method for profile privilege
	 *
	 * @param string $newProfilePrivilege new value of profile privilege
	 * @throws \InvalidArgumentException if $newProfilePrivilege is not a string or insecure
	 * @throws \RangeException if $newProfilePrivilege is > 1 characters
	 * @throws \TypeError if $newProfilePrivilege is not a string
	 **/
	public function setProfilePrivilege(string $newProfilePrivilege): void {
		// store the caption
		$this->profilePrivilege = $newProfilePrivilege;
	}
	/**
	 * mutator method for profile salt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if the salt is not 64 characters
	 * @throws \TypeError if the profile salt is not a string
	 */
	public function setProfileSalt(string $newProfileSalt): void {
		//enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		//enforce that the salt is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the salt is exactly 64 characters.
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("profile salt must be 128 characters"));
		}
		//store the hash
		$this->profileSalt = $newProfileSalt;
	}
	/**
	 * accessor method for username
	 *
	 * @return string value of username
	 **/
	public function getProfileUsername(): string {
		return ($this->profileUsername);
	}
	/**
	 * mutator method for username
	 *
	 * @param string $newProfileUsername new value of username
	 * @throws \InvalidArgumentException if $newProfileUsername is not a string or insecure
	 * @throws \RangeException if $newProfileUsername is > 50 characters
	 * @throws \TypeError if $newProfileUsername is not a string
	 **/
	public function setProfileUsername(string $newProfileUsername): void {
		// verify the username is secure
		$newProfileUsername = trim($newProfileUsername);
		$newProfileUsername = filter_var($newProfileUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileUsername) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		// verify the username will fit in the database
		if(strlen($newProfileUsername) > 50) {
			throw(new \RangeException("username is too large"));
		}
		// store the username
		$this->profileUsername = $newProfileUsername;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["profileId"] = $this->profileId->toString();
		unset($fields["profileActivationToken"]);
		unset($fields["profileHash"]);
		unset($fields["profileSalt"]);
		return ($fields);
	}
}