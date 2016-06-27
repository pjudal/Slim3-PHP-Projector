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
		$pdo = $this->ProjectsDao->getConnection();

	    $projectEmpty = $this->ProjectsDao->isEmpty($pdo);
	    if ($projectEmpty == 0)	$projectEmpty = 1;
	    else $projectEmpty = 0;

	    $_SESSION["projectEmpty"] = $projectEmpty;

	    if ($projectEmpty == 0) {
	    	$projects = $this->ProjectsDao->selectProjects($pdo);
	    	$_SESSION["projects"] = $projects;
	    }
	    return $projectEmpty;
	}
}