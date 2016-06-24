<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Models\Projects;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class CreateProjectModel {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

	public function create_project (Request $request, Response $response, $args) {
		$code = $_POST["code"];
		$name = $_POST["name"];
		$remarks = $_POST["remarks"];
		$budget = $_POST["budget"];

		// Create connection
		$settings = $this->ci->get('settings');
		$db_connection = $settings['db_connection'];

		$servername = $db_connection["servername"];
		$username = $db_connection["username"];
		$password = $db_connection["password"];
		$dbname = $db_connection["dbname"];
		
		$conn = new \mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$stmt = $conn->prepare("INSERT INTO projects
				(code,
				name,
				remarks,
				budget)
			VALUES
				(?,
				?,
				?,
				?)");

		$stmt->bind_param("sssd", $code, $name, $remarks, $budget);
		// If query is succesful, tell controller to render success page, otherwise the failure page.
		if ($stmt->execute()) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

}