<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Models\Persons;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class CreatePersonModel {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
		$this->PersonsDao = new \Netzwelt\Data\PersonsDao($this->ci->get('settings'));
	}

	public function create_person (Request $request, Response $response, $args) {
		$last_name = $_POST["last_name"];
		$first_name = $_POST["first_name"];
		$username = $_POST["username"];
		$password = $_POST["password"];

		// Create connection
		$pdo = $this->PersonsDao->getConnection();

		$insertSuccessful = $this->PersonsDao->insertPerson($pdo, $last_name, $first_name,
			$username, $password);

		if ($insertSuccessful == 1)	return TRUE;
		else return FALSE;
	}
}