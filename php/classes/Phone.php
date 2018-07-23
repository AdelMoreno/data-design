<?php
namespace AdelMoreno\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/classes/autoload.php");

require_once ("autoload.php");
require_once (dirname(__DIR__,1) . "../vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/** @author Adel Moreno <amoreno28@cnm.edu>
 * Version 1.0.0
 */
class Phone {
	/**
	 * id for phone, this is the primary key
	 * @var Uuid $phoneId
	 */
	private $phoneId;
	// @var string $phoneBrand
	private $phoneBrand;
	// @var string $phoneModel
	private $phoneModel;
	// @var string $phoneCamera
	private $phoneCamera;
	// @var string $phoneScreen
	private $phoneScreen;
	//@var string $phoneProcessor
	private $phoneProcessor;
	// @var $phoneRam
	private $phoneRam;
	// @var $phoneMemory
	private $phoneMemory;
	// @var $phoneBattery
	private $phoneBattery;

	public function __construct($newPhoneId, string $newPhoneBrand,
string $newPhoneModel,string $newPhoneCamera,string $newPhoneScreen,string $newPhoneProcessor,
string $newPhoneRam,string $newPhoneMemory,string $newPhoneBattery) {
		try{
			$this->setPhoneId($newPhoneId);
			$this->setPhoneBrand($newPhoneBrand);
			$this->setPhoneModel($newPhoneModel);
			$this->setPhoneCamera($newPhoneCamera);
			$this->setPhoneScreen($newPhoneScreen);
			$this->setPhoneProcessor($newPhoneProcessor);
			$this->setPhoneRam($newPhoneRam);
			$this->setPhoneMemory($newPhoneMemory);
			$this->setPhoneBattery($newPhoneBattery);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception)) ;
		}
	}

	/**
	 * accessor method for phoneId
	 *@return Uuid value of tweet id
	 **/

	public function getPhoneId() : Uuid{
		return($this->phoneId);
	}

	/**
	 * mutator method for phone id
	 *
	 * @param Uuid/string $newPhoneId new value of phone
	 *
	 * @throws \RangeException if $newPhoneId is n
	 * @throws  \TypeError if $newPhoneId is not a uuid
	 **/

	public function setPhoneId($newPhoneId) : void {
		try {
			$uuid = self::validateUuid($newPhoneId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store the phone id
		$this->phoneId = $uuid;
	}

	/**
	 * accessor method for phone brand
	 * @return value of phone brand
	 **/


	public function getPhoneBrand(): string {
		return ($this->phoneBrand);
	}

	/**
	 *  mutator method for phone brand
	 * @param string $newPhoneBrand new value of phone brand
	 *
	 * @throws \InvalidArgumentException if $newPhoneBrand is not a string or insecure
	 * @throws \RangeException if $newPhoneBrand is > 64 characters
	 * @throws \TypeError if $newPhoneBrand is not a string
	 **/

	public function setPhoneBrand (string
	$newPhoneBrand): void {
		//verify phone brand content is secure
		$newPhoneBrand = trim($newPhoneBrand);
		$newPhoneBrand = filter_var($newPhoneBrand,
		FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneBrand)=== true) {
			throw(new \InvalidArgumentException("PhoneBrand is empty or insecure"));
	}

		//verify the email content will fit in the database
	if(strlen($newPhoneBrand) > 64) {
	throw(new \RangeException("Phone brand content too large"));
	}

		//store the phone brand content
	$this->phoneBrand = $newPhoneBrand;
}

	/**
	 * accessor method for phone model
	 * @return value of phone model
	 **/

	public function getPhoneModel():string {
		return($this->phoneModel);
	}

	/**
	 *  mutator method for phone model
	 * @param string $newPhoneModel new value of phone model
	 *
	 * @throws \InvalidArgumentException if $newPhoneModel is not a string or insecure
	 * @throws \RangeException if $newPhoneBrand is > 128 characters
	 * @throws \TypeError if $newPhoneModel is not a string
	 **/

	public function setPhoneModel (string
	$newPhoneModel): void {
		//verify phone model content is secure
		$newPhoneModel = trim($newPhoneModel);
		$newPhoneModel = filter_var($newPhoneModel,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneModel)=== true) {
			throw(new \InvalidArgumentException("PhoneModel is empty or insecure"));
		}

		//verify the phone model content will fit in the database
		if(strlen($newPhoneModel) > 128) {
			throw(new \RangeException("Phone model content too large"));
		}

		//store the phone model content
		$this->phoneModel = $newPhoneModel;
	}

	/**
	 * accessor method for phone camera
	 * @return string value of phone camera
	 **/

	public function getPhoneCamera():string {
		return($this->phoneCamera);
	}

	/**
	 *  mutator method for phone camera
	 * @param string $newPhoneCamera new value of phone camera
	 *
	 * @throws \InvalidArgumentException if $newPhoneCamera is not a string or insecure
	 * @throws \RangeException if $newPhoneCamera is > 32 characters
	 * @throws \TypeError if $newPhoneCamera is not a string
	 **/

	public function setPhoneCamera (string
	$newPhoneCamera): void {
		//verify phone camera content is secure
		$newPhoneCamera = trim($newPhoneCamera);
		$newPhoneCamera = filter_var($newPhoneCamera,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneCamera)=== true) {
			throw(new \InvalidArgumentException("PhoneCamera is empty or insecure"));
		}

		//verify the phone camera content will fit in the database
		if(strlen($newPhoneCamera) > 32) {
			throw(new \RangeException("Phone camera content too large"));
		}

		//store the phone camera content
		$this->phoneCamera = $newPhoneCamera;
	}

	/**
	 * accessor method for phone screen
	 * @return string value of phone screen
	 **/

	public function getPhoneScreen():string {
		return($this->phoneScreen);
	}

	/**
	 *  mutator method for phone screen
	 * @param string $newPhoneScreen new value of phone screen
	 *
	 * @throws \InvalidArgumentException if $newPhoneScreen is not a string or insecure
	 * @throws \RangeException if $newPhoneBrand is > 64 characters
	 * @throws \TypeError if $newPhoneScreen is not a string
	 **/

	public function setPhoneScreen (string
	$newPhoneScreen): void {
		//verify phone screen content is secure
		$newPhoneScreen = trim($newPhoneScreen);
		$newPhoneScreen = filter_var($newPhoneScreen,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneScreen)=== true) {
			throw(new \InvalidArgumentException("PhoneScreen is empty or insecure"));
		}

		//verify the phone screen content will fit in the database
		if(strlen($newPhoneScreen) > 64) {
			throw(new \RangeException("Phone screen content too large"));
		}

		//store the phone screen content
		$this->phoneScreen = $newPhoneScreen;
	}

	/**
	 * accessor method for phone processor
	 * @return string value of phone processor
	 **/

	public function getPhoneProcessor():string {
		return($this->phoneProcessor);
	}

	/**
	 *  mutator method for phone processor
	 * @param string $newPhoneProcessor new value of phone processor
	 *
	 * @throws \InvalidArgumentException if $newPhoneProcessor is not a string or insecure
	 * @throws \RangeException if $newPhoneProcessor is > 64 characters
	 * @throws \TypeError if $newPhoneProcessor is not a string
	 **/

	public function setPhoneProcessor (string
	$newPhoneProcessor): void {
		//verify phone processor content is secure
		$newPhoneProcessor = trim($newPhoneProcessor);
		$newPhoneProcessor = filter_var($newPhoneProcessor,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneProcessor)=== true) {
			throw(new \InvalidArgumentException("PhoneProcessor is empty or insecure"));
		}

		//verify the phone processor content will fit in the database
		if(strlen($newPhoneProcessor) > 64) {
			throw(new \RangeException("Phone processor content too large"));
		}

		//store the phone processor content
		$this->phoneProcessor = $newPhoneProcessor;
	}

	/**
	 * accessor method for phone ram
	 * @return string value of phone ram
	 **/

	public function getPhoneRam():string {
		return($this->phoneRam);
	}

	/**
	 *  mutator method for phone ram
	 * @param string $newPhoneRam new value of phone ram
	 *
	 * @throws \InvalidArgumentException if $newPhoneRam is not a string or insecure
	 * @throws \RangeException if $newPhoneRam is > 8 characters
	 * @throws \TypeError if $newPhoneRam is not a string
	 **/

	public function setPhoneRam (string
	$newPhoneRam): void {
		//verify phone ram content is secure
		$newPhoneRam = trim($newPhoneRam);
		$newPhoneRam = filter_var($newPhoneRam,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneRam)=== true) {
			throw(new \InvalidArgumentException("PhoneRam is empty or insecure"));
		}

		//verify the phone ram content will fit in the database
		if(strlen($newPhoneRam) > 8) {
			throw(new \RangeException("Phone ram content too large"));
		}

		//store the phone model content
		$this->phoneRam = $newPhoneRam;
	}

	/**
	 * accessor method for phone memory
	 * @return string value of phone memory
	 **/

	public function getPhoneMemory():string {
		return($this->phoneMemory);
	}

	/**
	 *  mutator method for phone memory
	 * @param string $newPhoneMemory new value of phone memory
	 *
	 * @throws \InvalidArgumentException if $newPhoneMemory is not a string or insecure
	 * @throws \RangeException if $newPhoneMemory is > 32 characters
	 * @throws \TypeError if $newPhoneMemory is not a string
	 **/

	public function setPhoneMemory (string
	$newPhoneMemory): void {
		//verify phone memory content is secure
		$newPhoneMemory = trim($newPhoneMemory);
		$newPhoneMemory = filter_var($newPhoneMemory,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneMemory)=== true) {
			throw(new \InvalidArgumentException("PhoneMemory is empty or insecure"));
		}

		//verify the phone memory content will fit in the database
		if(strlen($newPhoneMemory) > 32) {
			throw(new \RangeException("Phone memory content too large"));
		}

		//store the phone memory content
		$this->phoneMemory = $newPhoneMemory;
	}

	/**
	 * accessor method for phone battery
	 * @return string value of phone battery
	 **/

	public function getPhoneBattery():string {
		return($this->phoneBattery);
	}

	/**
	 *  mutator method for phone battery
	 * @param string $newPhoneBattery new value of phone battery
	 *
	 * @throws \InvalidArgumentException if $newPhoneBattery is not a string or insecure
	 * @throws \RangeException if $newPhoneBattery is > 32 characters
	 * @throws \TypeError if $newPhoneBattery is not a string
	 **/

	public function setPhoneBattery (string
	$newPhoneBattery): void {
		//verify phone battery content is secure
		$newPhoneBattery = trim($newPhoneBattery);
		$newPhoneBattery = filter_var($newPhoneBattery,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneBattery)=== true) {
			throw(new \InvalidArgumentException("PhoneModel is empty or insecure"));
		}

		//verify the phone battery content will fit in the database
		if(strlen($newPhoneBattery) > 32) {
			throw(new \RangeException("Phone model content too large"));
		}

		//store the phone battery content
		$this->phoneBattery = $newPhoneBattery;
	}

};