<?php
namespace MarcinsHW2\models;

/**
 * Password model class
 *
 * @author it's complicated
 * @version 0.2
 */

class Password {
	
	/**
	 * @var string $passString the password
	 * @var bool $valid  the password is valid
	 * @var bool $validated the password has been validated
	 * @var string[] $errors lists errors if password not valid
	 */	

	private $passString = '';
	private $valid = false;
	private $validated = false;
	private $errors = array();
	
	public function __construct($passString)
	{
		$this->passString=$passString;
	}
	
	/**
	* Returns the validity of the password
	*
	* @return bool
	*/
	public function isValid() {
		return $this->validated && $this->valid;
	}
	
	/**
	* Validates the password against a set of rules
	*
	* @param Rule[] $rules an array of Rule objects
	*/
	public function validate($rules) {
		$tmpValid = true;
	    foreach ($rules as $rule) {
			$tmpValid = $tmpValid && $result = $rule->validate($this->passString);
			if ($result === false)
			$this->errors[] = $rule->getMessage();
		}
	
		if ($tmpValid === true) $this->valid = true;
		
		$this->validated = true;
	}

	/**
	 * Returns the password
	 *
	 * @return string
	 */
	public function getPassString() {
		return $this->passString;
	}
	
	/**
	 * Echoes the error list
	 *
	 */
	public function getErrors()
	{
		foreach ($this->errors as $error)
		{
			echo $error."\n";
		}
	}
}
