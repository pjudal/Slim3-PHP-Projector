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
		$this->ProjectsDao = new \Netzwelt\Data\ProjectsDao($this->ci->get('settings'));
	}

	public function assign_project_landing (Request $request, Response $response, $args) {
		// Create connection
		$pdo = $this->ProjectsDao->getConnection();

		$proj_code = $_COOKIE['project_to_add_to'];

		// Put current project's id in a cookie
	    $id = $this->ProjectsDao->selectID($pdo, $proj_code);

	    $_SESSION["proj_id"] = $id;
	    	// set the cookie
	    $cookie_name = "proj_id";
	    $cookie_value = $id;
	    setcookie($cookie_name, $cookie_value);

		// Put project name in a session variable
	    $name = $this->ProjectsDao->selectName($pdo, $proj_code);
	    $_SESSION["proj_name"] = $name;

	    // List of unassigned persons in current project
		$unassigned_persons = $this->ProjectsDao->returnUnassigned($pdo, $proj_code);
		$_SESSION["unassigned_persons"] = $unassigned_persons;

		// List of assigned persons in current project
        $assigned_persons = $this->ProjectsDao->returnAssigned($pdo, $proj_code);
		$_SESSION["assigned_persons"] = $assigned_persons;
	}

	public function assign_project (Request $request, Response $response, $args) {
		$person_id = $_POST['person_id'];
		$project_id = $_POST['proj_id'];

		// Create connection
		$pdo = $this->ProjectsDao->getConnection();

		// Insert the person into projectassignments
	    $this->ProjectsDao->insertProjectAssignment($pdo, $person_id, $project_id);

		// List of assigned persons in current project
		$assigned_persons = $this->ProjectsDao->returnAssignedID($pdo, $project_id);
		$_SESSION["assigned_persons"] = $assigned_persons;

		// List of unassigned persons in current project
        $unassigned_persons = $this->ProjectsDao->returnUnassignedID($pdo, $project_id);
		$_SESSION["unassigned_persons"] = $unassigned_persons;

		echo "Model Part: OK. Person added. Job's done.";
	}

	public function remove (Request $request, Response $response, $args) {
		$person_id = $_POST['person_id'];
		$project_id = $_POST['proj_id'];
		
		// Create connection
		$pdo = $this->ProjectsDao->getConnection();

		// Delete from projectassignments
	    $this->ProjectsDao->deleteProjectAssignment($pdo, $person_id, $project_id);

	    // List of assigned persons in current project
        $assigned_persons = $this->ProjectsDao->returnAssignedID($pdo, $project_id);
		$_SESSION["assigned_persons"] = $assigned_persons;

		// List of unassigned persons in current project
		$unassigned_persons = $this->ProjectsDao->returnUnassignedID($pdo, $project_id);
		$_SESSION["unassigned_persons"] = $unassigned_persons;

		//echo "Model Part: OK. Person removed. Job's done.";
		echo $person_id;
	}

}