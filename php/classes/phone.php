<?php

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

/** @author Adel Moreno Versions 1.0.0 */
class phone {
	/* this is the primary key*/
	private $phoneId;
	/* all of these lines are attributes*/
	private $phoneBrand;
	private $phoneModel;
	private $phoneCamera;
	private $phoneScreen;
	private $phoneProcessor;
	private $phoneRam;
	private $phoneMemory;
	private $phoneBattery;

	public function getPhoneId() : Uuid{
		return($this->phoneId);
	}

	public function setPhoneId($newPhoneId) : void {
		try {
			$uuid = self::validateUuid($newPhoneId);
		} catch(\InvalidArgumentException | \RangeException | \Exception
		| \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->phoneId = $uuid;
	}

	public function setPhoneBrand (string
		$newPhoneBrand): void {
		$newPhoneBrand = trim($newPhoneBrand);
		$newPhoneBrand = filter_var($newPhoneBrand,
		FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneBrand)=== true) {
			throw(new \InvalidArgumentException("PhoneBrand is empty or insecure"));
	}

if(strlen($newPhoneBrand) > 64) {
	throw(new \RangeException("Phone brand content too large"));
	}

	$this->phoneBrand = $newPhoneBrand;
}

	public function getPhoneBrand(): string {
		return ($this->phoneBrand);
	}


		public function setPhoneModel (string
$newPhoneModel): void {
			$newPhoneModel = trim($newPhoneModel);
			$newPhoneModel = filter_var($newPhoneModel,
				FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newPhoneModel)=== true) {
				throw(new \InvalidArgumentException("PhoneModel is empty or insecure"));
			}

			if(strlen($newPhoneModel) > 128) {
				throw(new \RangeException("Phone model content too large"));
			}

			$this->phoneModel = $newPhoneModel;
		}

	public function getPhoneModel():string {
		return($this->phoneModel);
	}

	public function setPhoneCamera (string
$newPhoneCamera): void {
		$newPhoneCamera = trim($newPhoneCamera);
		$newPhoneCamera = filter_var($newPhoneCamera,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneCamera)=== true) {
			throw(new \InvalidArgumentException("PhoneCamera is empty or insecure"));
		}

		if(strlen($newPhoneCamera) > 32) {
			throw(new \RangeException("Phone camera content too large"));
		}

		$this->phoneCamera = $newPhoneCamera;
	}

	public function getPhoneCamera():string {
		return($this->phoneCamera);
	}

	public function setPhoneScreen (string
		$newPhoneScreen): void {
		$newPhoneScreen = trim($newPhoneScreen);
		$newPhoneScreen = filter_var($newPhoneScreen,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneScreen)=== true) {
			throw(new \InvalidArgumentException("PhoneScreen is empty or insecure"));
		}

		if(strlen($newPhoneScreen) > 64) {
			throw(new \RangeException("Phone screen content too large"));
		}

		$this->phoneScreen = $newPhoneScreen;
	}

	public function getPhoneScreen():string {
		return($this->phoneScreen);
	}

	public function setPhoneProcessor (string
$newPhoneProcessor): void {
		$newPhoneProcessor = trim($newPhoneProcessor);
		$newPhoneProcessor = filter_var($newPhoneProcessor,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneProcessor)=== true) {
			throw(new \InvalidArgumentException("PhoneProcessor is empty or insecure"));
		}

		if(strlen($newPhoneProcessor) > 64) {
			throw(new \RangeException("Phone processor content too large"));
		}

		$this->phoneProcessor = $newPhoneProcessor;
	}

	public function getPhoneProcessor():string {
		return($this->phoneProcessor);
	}

	public function setPhoneRam (string
$newPhoneRam): void {
		$newPhoneRam = trim($newPhoneRam);
		$newPhoneRam = filter_var($newPhoneRam,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneRam)=== true) {
			throw(new \InvalidArgumentException("PhoneRam is empty or insecure"));
		}

		if(strlen($newPhoneRam) > 8) {
			throw(new \RangeException("Phone ram content too large"));
		}

		$this->phoneModel = $newPhoneRam;
	}

	public function getPhoneRam():string {
		return($this->phoneRam);
	}

	public function setPhoneMemory (string
$newPhoneMemory): void {
		$newPhoneMemory = trim($newPhoneMemory);
		$newPhoneMemory = filter_var($newPhoneMemory,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneMemory)=== true) {
			throw(new \InvalidArgumentException("PhoneMemory is empty or insecure"));
		}

		if(strlen($newPhoneMemory) > 32) {
			throw(new \RangeException("Phone memory content too large"));
		}

		$this->phoneModel = $newPhoneMemory;
	}

	public function getPhoneMemory():string {
		return($this->phoneMemory);
	}

	public function setPhoneBattery (string
$newPhoneBattery): void {
		$newPhoneBattery = trim($newPhoneBattery);
		$newPhoneBattery = filter_var($newPhoneBattery,
			FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPhoneBattery)=== true) {
			throw(new \InvalidArgumentException("PhoneModel is empty or insecure"));
		}

		if(strlen($newPhoneBattery) > 32) {
			throw(new \RangeException("Phone model content too large"));
		}

		$this->phoneBattery = $newPhoneBattery;
	}

	public function getPhoneBattery():string {
		return($this->phoneBattery);
	}
};