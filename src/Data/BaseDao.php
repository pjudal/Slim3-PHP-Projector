<?php

namespace Netzwelt\Data;

abstract class BaseDao {
	
	public function __construct($settings) {
		$this->DatabaseSettings = $settings['db_connection'];
	}

	public function getConnection() {
		//Create connection

		$servername = $this->DatabaseSettings["servername"];
		$username = $this->DatabaseSettings["username"];
		$password = $this->DatabaseSettings["password"];
		$dbname = $this->DatabaseSettings["dbname"];
		$charset = 'utf8';

		$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
		$options = [
		    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
		    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		    \PDO::ATTR_EMULATE_PREPARES   => false,
		];		


		try {
		    $pdo = new \PDO($dsn, $username, $password, $options);
		    return $pdo;
		} catch(\PDOException $e) {
		    die('Could not connect to the database:' . $e);
		}
	}
}