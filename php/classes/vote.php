<?php

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

/** @author Adel Moreno Versions 1.0.0 */
class vote {
	/*this is a foreign key */
	private $voteProfileId;
	/*this is a foreign key that with voteProfileId makes a primary key*/
	private $votePhoneId;

	public $voteType;

	public function getVoteProfileId():string {
		return ($this->voteProfileId);
	}

	public function setVoteProfileId($newVoteProfileId) : void {
		try {
			$uuid = self::validateUuid($newVoteProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->voteProfileId = $uuid;
	}

	public function getVotePhoneId():Uuid {
		return($this->votePhoneId);
	}

	public function setVotePhoneId($newVotePhoneId) : void {
		try {
			$uuid = self::validateUuid($newVotePhoneId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType ($exception->getMessage(), 0, $exception));
		}
		$this->votePhoneId = $uuid;
	}

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

		$this->voteType = $newVoteType;
	}
}