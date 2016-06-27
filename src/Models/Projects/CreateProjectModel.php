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
		$this->ProjectsDao = new \Netzwelt\Data\ProjectsDao($this->ci->get('settings'));
	}

	public function create_project (Request $request, Response $response, $args) {
		$code = $_POST["code"];
		$name = $_POST["name"];
		$remarks = $_POST["remarks"];
		$budget = $_POST["budget"];

		// Create connection
		$pdo = $this->ProjectsDao->getConnection();

		$insertSuccessful = $this->ProjectsDao->insertProject($pdo, $code, $name, $remarks, $budget);
		if ($insertSuccessful == 1)	return TRUE;
		else return FALSE;
	}

}