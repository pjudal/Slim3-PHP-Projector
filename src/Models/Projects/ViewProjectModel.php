<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Models\Projects;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ViewProjectModel {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

	public function view_projects (Request $request, Response $response, $args) {
		//return $this->ci->renderer->render($response, '\Projects\view_projects.php', $args);

		//Create connection
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

		$stmt = $conn->prepare("SELECT EXISTS(SELECT 1 FROM projects)");
		$stmt->execute();
		$result = $stmt->get_result();

		while ($row = $result->fetch_array(MYSQLI_NUM))
	    {
	        foreach ($row as $r)
	        {
	        	if ($r == 0)	$project_empty = 1;
	        	else	$project_empty = 0;
	        }
	    }
	    $_SESSION["project_empty"] = $project_empty;
	    if ($project_empty == 0) {
	    	$projects = [];
	    	$result = mysqli_query($conn,"SELECT * FROM projects");
	    	while($row = mysqli_fetch_array($result)) {
	    		array_push($projects, $row);
	    	}
	    	$_SESSION["projects"] = $projects;
	    }
	    return $project_empty;
	}
}