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
		$this->ProjectsDao = new \Netzwelt\Data\ProjectsDao($this->ci->get('settings'));
	}

	public function view_projects (Request $request, Response $response, $args) {
		$conn = $this->ProjectsDao->getConnection();

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