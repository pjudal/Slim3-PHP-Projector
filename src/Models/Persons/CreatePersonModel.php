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
	}

	public function create_person (Request $request, Response $response, $args) {
		// Create connection
		$settings = $this->ci->get('settings');
		$db_connection = $settings['db_connection'];

		$servername = $db_connection["servername"];
		$username = $db_connection["username"];
		$password = $db_connection["password"];
		$dbname = $db_connection["dbname"];
		
		$conn = new \mysqli($servername, $username, $password, $dbname);

		$last_name = $_POST["last_name"];
		$first_name = $_POST["first_name"];
		$username = $_POST["username"];
		$password = $_POST["password"];

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}		

		$stmt = $conn->prepare("INSERT INTO persons
				(last_name,
				first_name,
				username,
				password)
			VALUES
				(?,
				?,
				?,
				?)");

		$stmt->bind_param("ssss", $last_name, $first_name, $username, $password);
		// If query was successful tell controller to render success page, otherwise the failure page
		if ($stmt->execute()) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
}