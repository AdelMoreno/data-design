<?php

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

/** @author Adel Moreno <amoreno28@cnm.edu>
 * Version 1.0.0
 */
class Vote {
	/**
	 * id of the profile that made the vote, this is a foreign key
	 * @var Uuid $voteProfileId
	 **/
	private $voteProfileId;
	/**
	 * id of the phone that gets the vote, this is a foreign key
	 * @var Uuid $votePhoneId
	 **/
	private $votePhoneId;
	/**
	 * type of the vote that was made
	 * @var string $voteType
	 **/

	public $voteType;

	public function __construct($newVoteProfileId, $newVotePhoneId,
		 string $newVoteType) {
		try{
			$this->setVoteProfileId($newVoteProfileId);
			$this->setVotePhoneId($newVotePhoneId);
			$this->setVoteType($newVoteType);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for voteProfileId
	 *@return Uuid value of vote profile id
	 **/

	public function getVoteProfileId():string {
		return ($this->voteProfileId);
	}

	/**
	 * mutator method for vote profile id
	 *
	 * @param Uuid/string $newVoteProfileId new value of vote profile id
	 *
	 * @throws \RangeException if $newVoteProfileId is n
	 * @throws \TypeError if $newVoteProfileId is not a uuid
	 **/

	public function setVoteProfileId($newVoteProfileId) : void {
		try {
			$uuid = self::validateUuid($newVoteProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store the phone id
		$this->voteProfileId = $uuid;
	}

	/**
	 * accessor method for votePhoneId
	 *@return Uuid value of vote phone id
	 **/

	public function getVotePhoneId():Uuid {
		return($this->votePhoneId);
	}

	/**
	 * mutator method for vote phone id
	 *
	 * @param Uuid/string $newVotePhoneId new value of vote phone id
	 *
	 * @throws \RangeException if $newVotePhoneId is n
	 * @throws \TypeError if $newVotePhoneId is not a uuid
	 **/

	public function setVotePhoneId($newVotePhoneId) : void {
		try {
			$uuid = self::validateUuid($newVotePhoneId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType ($exception->getMessage(), 0, $exception));
		}

		//convert and store the phone id
		$this->votePhoneId = $uuid;
	}

	/**
	 * accessor method for voteType
	 *@return string value of vote type
	 **/

	public function getVoteType():string {
		return($this->voteType);
	}
/* this function checks to make sure that the vote string length is appropriate and less than 8 characters*/
	public function setVoteType (string
	 $newVoteType): void {
		$newVoteType = trim($newVoteType);
		$newVoteType = filter_var($newVoteType,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newVoteType)=== true) {
			throw(new \InvalidArgumentException("VoteType is empty or insecure"));
		}

		// verify vote type will fit in the database
		if(strlen($newVoteType) > 8) {
			throw(new \RangeException("Vote type content too large"));
		}

		//store the vote type
		$this->voteType = $newVoteType;
	}
}