<?php

require_once("autoload.php");
require_once (dirname(__DIR__,2) . "/vendor/autoload.php");

/**
 * @author Adel Moreno <amoreno28@cnm.edu>
 * Version 1.0.0
 **/
class Profile {
	/**
	 * id for this profile, this is the primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * this is the user's password
	 * @var string $profileHash
	 **/
	private $profileHash;
	/**
	 * this is the user's email
	 * @var string$profileEmail
	 **/
	private $profileEmail;


	public function __construct($newProfileId, string $newProfileHash,
	string $newProfileEmail) {
		try{
			$this->setProfileId($newProfileId);
			$this->setProfileHash($newProfileHash);
			$this->setProfileEmail($newProfileEmail);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	* @return Uuid value of profile id
	**/

	public function getProfileId(): Uuid {
		return ($this->profileId);
	}
/**
 * mutator method for profile id
 *
 * @param Uuid/string $newProfileId new value of profile
 *
 * @throws \RangeException if $newProfileId is n
 * @throws \TypeError if $newProfileId is not a uuid
 **/
	public function setProfileId($newProfileId) : void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}

			//convert and store profile id
			$this->profileId = $uuid;
		}

	/**
	 * accessor method for profile hash
	* @return string value of profile hash
	 **/

	public function getProfileHash(): string {
		return ($this->profileHash);
	}

	/**
	 *  mutator method for profile hash
	 * @param string $newProfileHash new value of profile hash
	 *
	 * @throws \InvalidArgumentException if $newProfileHash is not a string or insecure
	 * @throws \RangeException if $newProfileHash is > 94 characters
	 * @throws \TypeError if $newProfileHash is not a string
	 **/

	public function setProfileHash (string
		 $newProfileHash): void {
		// verify the hash content is secure
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = filter_var($newProfileHash,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileHash)=== true) {
			throw(new \InvalidArgumentException("PhoneBrand is empty or insecure"));
		}

		//verify the hash content will fit in the database
		if(strlen($newProfileHash) > 94) {
			throw(new \RangeException("Phone password content too large"));
		}
		// store the hash content
		$this->profileHash = $newProfileHash;
	}

	/**
	 * accessor method for profile email
	*
	* @return string value of profile email
	 **/

	public function getProfileEmail(): string {
		return ($this->profileEmail);
	}

	/**
	 * mutator method profile email
	 * @param string $newProfileEmail new value of profile email
	 *
	 * @throws \InvalidArgumentException if $newProfileEmail is not a string or insecure
	 * @throws \RangeException if $newProfileEmail is > 128 characters
	 * @throws \TypeError is $newProfileEmail is not a string
	 **/

	public function setProfileEmail (string
		 $newProfileEmail): void {
		//verify email content is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileEmail)=== true) {
			throw(new \InvalidArgumentException("Email is empty or insecure"));
		}
		//verify the email content will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("Phone brand content too large"));
		}
		//store the email content
		$this->profileEmail = $newProfileEmail;
	}
};

