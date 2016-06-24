<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Models\Projects;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AssignProjectModel {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

	public function assign_project_landing (Request $request, Response $response, $args) {
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


		$proj_code = $_COOKIE['project_to_add_to'];
		//$assign_person = $_COOKIE['assign_person'];
		// ^ wala pang value from the form

		// Put current project's id in a cookie
		$stmt = $conn->prepare("SELECT id FROM projects WHERE code=?");
	    $stmt->bind_param("s", $proj_code);
	    $stmt->execute();
	    $proj_id = $stmt->get_result();
	    $row = $proj_id->fetch_array(MYSQLI_NUM);
	    $_SESSION["proj_id"] = $row[0];
	    	// set the cookie
	    $cookie_name = "proj_id";
	    $cookie_value = $row[0];
	    setcookie($cookie_name, $cookie_value);

		// Put project name in a session variable
		$stmt = $conn->prepare("SELECT name FROM projects WHERE code=?");
	    $stmt->bind_param("s", $proj_code);
	    $stmt->execute();
	    $proj_name = $stmt->get_result();
	    $row = $proj_name->fetch_array(MYSQLI_NUM);
	    $_SESSION["proj_name"] = $row[0];

	    // List of unassigned persons in current project
		$stmt = $conn->prepare("SELECT * FROM persons WHERE persons.id NOT IN
			(SELECT person_id FROM projectassignments WHERE project_id=
				(SELECT id FROM projects WHERE code=?))");
        $stmt->bind_param("s", $proj_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $unassigned_persons = [];
        while($row = mysqli_fetch_array($result)) {
        	array_push($unassigned_persons, $row);
        }
		$_SESSION["unassigned_persons"] = $unassigned_persons;

		// List of assigned persons in current project
		$stmt = $conn->prepare("SELECT * FROM persons WHERE persons.id IN
			(SELECT person_id FROM projectassignments WHERE project_id=
				(SELECT id FROM projects WHERE code=?))");
        $stmt->bind_param("s", $proj_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $assigned_persons = [];
        while($row = mysqli_fetch_array($result)) {
        	array_push($assigned_persons, $row);
        }
		$_SESSION["assigned_persons"] = $assigned_persons;
	}



	public function assign_project (Request $request, Response $response, $args) {
		$person_id = $_POST['person_id'];
		$proj_id = $_POST['proj_id'];
		
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

		// Insert the person into projectassignments
		$stmt = $conn->prepare("INSERT INTO projectassignments (person_id, project_id)
			VALUES (?, ?)");
	    $stmt->bind_param("dd", $person_id, $proj_id);
	    $stmt->execute();

		// List of assigned persons in current project
		$stmt = $conn->prepare("SELECT * FROM persons WHERE persons.id IN
			(SELECT person_id FROM projectassignments WHERE project_id=?)");
        $stmt->bind_param("d", $proj_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $assigned_persons = [];
        while($row = mysqli_fetch_array($result)) {
        	array_push($assigned_persons, $row);
        }
		$_SESSION["assigned_persons"] = $assigned_persons;

		// List of unassigned persons in current project
		$stmt = $conn->prepare("SELECT * FROM persons WHERE persons.id NOT IN
			(SELECT person_id FROM projectassignments WHERE project_id=?)");
        $stmt->bind_param("d", $proj_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $unassigned_persons = [];
        while($row = mysqli_fetch_array($result)) {
        	array_push($unassigned_persons, $row);
        }
		$_SESSION["unassigned_persons"] = $unassigned_persons;

		echo "Model Part: OK. Person added. Job's done.";
	}

	public function remove (Request $request, Response $response, $args) {
		$person_id = $_POST['person_id'];
		$proj_id = $_POST['proj_id'];
		
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

		// Delete from projectassignments
		$stmt = $conn->prepare("DELETE FROM projectassignments WHERE person_id=? AND project_id=?");
	    $stmt->bind_param("dd", $person_id, $proj_id);
	    $stmt->execute();

	    // List of assigned persons in current project
		$stmt = $conn->prepare("SELECT * FROM persons WHERE persons.id IN
			(SELECT person_id FROM projectassignments WHERE project_id=?)");
        $stmt->bind_param("d", $proj_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $assigned_persons = [];
        while($row = mysqli_fetch_array($result)) {
        	array_push($assigned_persons, $row);
        }
		$_SESSION["assigned_persons"] = $assigned_persons;

		// List of unassigned persons in current project
		$stmt = $conn->prepare("SELECT * FROM persons WHERE persons.id NOT IN
			(SELECT person_id FROM projectassignments WHERE project_id=?)");
        $stmt->bind_param("d", $proj_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $unassigned_persons = [];
        while($row = mysqli_fetch_array($result)) {
        	array_push($unassigned_persons, $row);
        }
		$_SESSION["unassigned_persons"] = $unassigned_persons;

		//echo "Model Part: OK. Person removed. Job's done.";
		echo $person_id;
	}

}