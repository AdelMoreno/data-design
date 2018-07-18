<?php

require_once("autoload.php");
require_once (dirname(__DIR__,2) . "/vendor/autoload.php");

/** @author Adel Moreno Versions 1.0.0 */
class profile {
	/* this is the primary key*/
	private $profileId;
	/* this is the user's password*/
	private $profileHash;
	/* this is the user's email*/
	private $profileEmail;

	/*accessor method for profile id
	* return Uuid value of profile id
	*/

	public function getProfileId(): Uuid {
		return ($this->profileId);
	}
/*mutator method for profile id
*
 * * Uuid/string $newProfileId new value of profile
 *
 * throws \RancgeException if $newProfileId is n
 * throws \TypeError if $newProfileId is not a uuid
 */
	public function setProfileId($newProfileId) : void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
			$this->profileId = $uuid;
		}

	public function getProfileHash(): string {
		return ($this->profileHash);
	}

	public function getProfileEmail(): string {
		return ($this->profileEmail);
	}
};

