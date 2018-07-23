<?php
namespace AdelMoreno\DataDesign;

require_once("autoload.php");
require_once (dirname(__DIR__,2) . "/classes/autoload.php");

use Ramsey\Uuid\Uuid;

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
	 * @var string $profileEmail
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

	/**
	 * inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related erros occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO profile(profileId, profileHash, profileEmail) VALUES(:profileId, :profileHash, :profileEmail)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileHash" => $this->profileHash, "profileEmail" => $this->profileEmail];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		//create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Profile in mySql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related erros occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) :void {

		//creat query template
		$query = "UPDATE profile SET profileId = :profileId, profileHash = :profileHash, profileEmail = :profileEmail WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId->getBytes(), "profileHash" => $this->profileHash, "profileEmail" => $this->profileEmail];
		$statement->execute($parameters);
	}

	/**
	 * get the Profile by profileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileId profile id to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable is not the correct data type
	 **/
	public static function getProfileByProfileId(\PDO $pdo, $profileId) : ?Profile {
		// sanitize the profileId before searching
		try {
				$profileId = self::validateUuid($profileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT profileId, profileHash, profileEmail FROM profile WHERE profileId= :profileId";
		$statement = $pdo->prepare($query);

		//bind the profile id to the place holder in the template
		$parameters = ["profileId" => $profileId->getBytes()];
		$statement->execute($parameters);

		//grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileHash"], $row["profileEmail"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets the Profile by email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $profileEmail email to search for
	 * @return \SplFixedArray SPLFixedArray of Profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variable are no the correct data type
	 **/
	public static function getProfileByEmail(\PDO $pdo, string $profileEmail) : \SplFixedArray {
		// sanitize the description before searching
		$profileEmail = trim($profileEmail);
		$profileEmail = filter_var($profileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileEmail) === true) {
			throw(new \PDOException("email is invalid"));
		}

		// escape any mySQL wild cards
		$profileEmail = str_replace("_", "\\_", str_replace("%", "\\%", $profileEmail));

		//create query template
		$query = "SELECT profileId, profileHash, profileEmail FROM profile WHERE profileEmail LIKE :profileEmail";
		$statement = $pdo->prepare($query);

		//bind the email to the place holder in the template
		$profileEmail = "%profileEmail%";
		$parameters = ["profileEmail" => $profileEmail];
		$statement->execute($parameters);

		// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try{
				$profile = new Profile($row["profileId"], $row["profileHash"], $row["profileEmail"]);
				$profiles[$profiles->key()] = $profile;
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($profiles);
	}

};

