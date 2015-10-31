<?php
namespace MarcinsHW2\wrappers;

use MarcinsHW2\models\Password;
use MarcinsHW2\exceptions\LocalException;
use \PDO;

/**
 * database wrapper class
 * connects, reads from and writes to database
 *
 * @author Malgorzata Wierzchowska <vertice2@outlook.com>
 * @version 0.2
 */

class DatabaseWrapper
{
	/**
	 * @var null/PDO $db PDO
	 * @var string $host host	 
	 * @var string $dbname database name
	 * @var string $username user name
	 * @var string $password database password
	 */
	
	private $db = null;
	private $host = "localhost";
	private $dbname = "testdb";
	private $username = "root";
	private $password = null;

	/**
	 * Connects to database
	 */
	public function __construct()
	{
		try {
			$this->db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'root');
		}
		catch (Exception $ex)
		{
			throw new LocalException($ex->getMessage(), $ex->getCode(), $ex);
		}
		if($this->db===null) throw new LocalException("DBO not created", 0);

	}

	/**
	 * reads passwords from the database and returns them as array
	 *
	 * @return Password[] array of password objects
	 */
	public function getPasswords()
	{
		$stmt = $this->db->query('SELECT * FROM passwords');
		$passwords=array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$password = new Password($row['password']);
			array_push($passwords, $password);
		}
		return $passwords;
	}

	/**
	 * changes the value of 'valid' box to 1 for the password given as argument
	 *
	 * @param string $password password string
	 */
	public function saveValid($password)
	{
		$sSQL = 'UPDATE passwords SET valid=1 ';
		$sSQL.= 'WHERE password=:password; ';
		$stmt = $this->db->prepare($sSQL);
		$stmt->bindValue(':password', $password, PDO::PARAM_STR);
		$rows=$stmt->execute();
		if($rows==0) throw new LocalException("Change not saved to the database", 0);
	}
}