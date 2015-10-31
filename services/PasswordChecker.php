<?php
namespace MarcinsHW2\Services;

use MarcinsHW2\wrappers\YamlWrapper;
use MarcinsHW2\exceptions\LocalException;

/**
 * Password checker class
 * checks password validity
 *
 * @author Malgorzata Wierzchowska <vertice2@outlook.com>
 * @version 0.2
 */

class PasswordChecker
{
	/**
	 * @var YamlWrapper $yamlWrapper YamlWrapper class object
	 * @var Rule[] $rules array of Rule objects
	 */
	
	private $yamlWrapper = null;
	private $rules = array();

	/**
	 * Imports password rules from yaml file
	 */
	public function __construct()
	{
		try
		{
			$this->yamlWrapper = new YamlWrapper();
			$this->rules=$this->yamlWrapper->getRules();
		}
		catch (Exception $ex)
		{
			throw new LocalException($ex->getMessage(), $ex->getCode(), $ex);
		}
		if(empty($this->rules))
			throw new LocalException("Rules not imported", 0);
	}

	/**
	 * checks password against a set of rules
	 *
	 * @param Password  
	 * @return bool
	 */
	public function checkPassword($password=null)
	{
		$password->validate($this->rules);
	}

}