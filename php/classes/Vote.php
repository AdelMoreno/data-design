<?php
namespace AdelMoreno\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");

use Ramsey\Uuid\Uuid;

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



/**
 * inserts this Vote into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related erros occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/

public function insert(\PDO $pdo) : void {

	// create query template
	$query = "INSERT INTO vote(voteProfileId, votePhoneId, voteType) VALUES(:voteProfileId, :votePhoneId, :voteType)";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place holders in the template
	$parameters = ["voteProfileId" => $this->voteProfileId->getBytes(), "votePhoneId" => $this->votePhoneId, "voteType" => $this->voteType];
	$statement->execute($parameters);
}

/**
 * deletes this Vote from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function delete(\PDO $pdo) : void {

	//create query template
	$query = "DELETE FROM vote WHERE voteType = :voteType";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place holder in the template
	$parameters = ["voteType" => $this->voteType->getBytes()];
	$statement->execute($parameters);
}

/**
 * updates this Vote in mySql
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function update(\PDO $pdo) :void {

	//create query template
	$query = "UPDATE vote SET voteProfileId = :voteProfileId, votePhoneId = :votePhoneId, voteType = :voteType WHERE voteType = :voteType";
	$statement = $pdo->prepare($query);

	$parameters = ["voteProfileId" => $this->voteProfileId->getBytes(), "votePhoneId" => $this->votePhoneId, "voteType" => $this->voteType];
	$statement->execute($parameters);
}

/**
 * get the Vote by voteProfileId
 *
 * @param \PDO $pdo PDO connection object
 * @param Uuid|string $voteProfileId vote profile id to search for
 * @return Vote|null Vote found or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when a variable is not the correct data type
 **/
public static function getVoteByVoteProfileId(\PDO $pdo, $voteProfileId) : ?Profile {
	// sanitize the profileId before searching
	try {
		$voteProfileId = self::validateUuid($voteProfileId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}

	//create query template
	$query = "SELECT voteProfileId, votePhoneId, voteType FROM vote WHERE voteProfileId= :voteProfileId";
	$statement = $pdo->prepare($query);

	//bind the profile id to the place holder in the template
	$parameters = ["voteProfileId" => $voteProfileId->getBytes()];
	$statement->execute($parameters);

	//grab the profile from mySQL
	try {
		$vote = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {
			$vote = new Vote($row["voteProfileId"], $row["votePhoneId"], $row["voteType"]);
		}
	} catch(\Exception $exception) {
		// if the row couldn't be converted, rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return($vote);
}

/**
 * gets the Vote by voteType
 *
 * @param \PDO $pdo PDO connection object
 * @param string $voteType vote to search for
 * @return \SplFixedArray SPLFixedArray of Votes found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variable are no the correct data type
 **/
public static function getVoteByVoteType(\PDO $pdo, string $voteType) : \SplFixedArray {
	// sanitize the description before searching
	$voteType = trim($voteType);
	$voteType = filter_var($voteType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($voteType) === true) {
		throw(new \PDOException("email is invalid"));
	}

	// escape any mySQL wild cards
	$voteType = str_replace("_", "\\_", str_replace("%", "\\%", $voteType));

	//create query template
	$query = "SELECT voteProfileId, votePhoneId, voteType FROM vote WHERE voteType LIKE :voteType";
	$statement = $pdo->prepare($query);

	//bind the vote to the place holder in the template
	$voteType = "%voteType%";
	$parameters = ["voteType" => $voteType];
	$statement->execute($parameters);

	// build an array of votes
	$votes = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try{
			$vote = new Vote($row["voteProfileId"], $row["votePhoneId"], $row["voteType"]);
			$votes[$votes->key()] = $vote;
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return ($votes);
}

};

