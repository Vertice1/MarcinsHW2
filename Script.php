<?php
require_once "utility/Autoload.php";

use  MarcinsHW2\Wrappers\DatabaseWrapper;
use  MarcinsHW2\services\PasswordChecker;
use MarcinsHW2\models\Password;

/**
 * a script to run the whole lot
 * 
 * @author Malgorzata Wierzchowska <vertice2@outlook.com>
 * @version 0.2 
 */

/**
 * scans arguments for password and verbosity
 * if no password gets passwords from database
 * if no verbosity sets verbosity
 */

if(array_key_exists('1', $argv))
{
	if(is_numeric($argv[1]))
	{
		$verbosity = $argv[1];
		$objDataWrapper= new DatabaseWrapper();
		if($verbosity>4)
			echo "Polaczylem sie z baza danych hihihi\n";
		$arrPasswords = $objDataWrapper->getPasswords();
		if($verbosity>3)
			echo "Pobralem hasla\n";
	}
	else 
	{
		if(array_key_exists('2', $argv))
			$verbosity = $argv[2];
		else 
			$verbosity = 3;
		$arrPasswords=array();
		$password = new Password($argv[1]);
		array_push($arrPasswords, $password);
		if($verbosity>4)
			echo "Pobralem argumenty hihihi\n";
	}
}
else
{
	$objDataWrapper= new DatabaseWrapper();
	$arrPasswords = $objDataWrapper->getPasswords();
	$verbosity = 3;
}
if(empty($arrPasswords))
	throw new LocalException("Password list empty", 0);
/**
 * creates instance of passwordChecker class
 * and validated password(s)
 */
$objPasswordChecker = new PasswordChecker();
if($verbosity>3)
	echo "Obiekt PasswordChecker utworzony\n";
foreach($arrPasswords as $password)
{
	if($verbosity>0)
		echo $password->getPassString()."\n";
	$objPasswordChecker->checkPassword($password);
	if($password->isValid()===true)
	{
		if($verbosity>0)
			echo "Password passed the check\n";
	}
	else 
	{
		if($verbosity>0)
			echo "Password did not pass the check\n";
		if($verbosity>2)
			$password->getErrors();
	}

}
