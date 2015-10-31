<?php
namespace MarcinsHW2\models;

/**
 * Rule model class
 *
 * @author Malgorzata Wierzchowska <vertice2@outlook.com>
 * @version 0.2
 */

class Rule
{
	/**
	 * @var string $rule regex 
	 * @var string $errorMessage  error message if regex doesn't match
	 */
	
	private $rule='';
	private $errorMessage='';
	
	public function __construct($rule, $message)
	{
		$this->errorMessage=$message;
		$this->rule=$rule;
	}
	
	/**
	 * Returns the rule regex
	 *
	 * @return string
	 */
	
	public function getRule()
	{
		return $this->rule;
	}
	
	/**
	 * Returns the error message
	 *
	 * @return string
	 */
	
	public function getMessage()
	{
		return $this->errorMessage;
	}

	/**
	* Returns the validity of the password parameter
	*
	* @param string
	* @return bool
	*/
	
	public function validate($password)
	{
		if (preg_match($this->rule, $password))
			return true;
		else return false;
	}
}
