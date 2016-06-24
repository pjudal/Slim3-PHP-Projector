<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Controllers;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ProjectsController {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

	public function view_projects (Request $request, Response $response, $args) {
		//$ProjectModel = new \Netzwelt\Models\Projects\ViewProjectModel($this->ci);
		//return $ProjectModel->view_projects($request, $response, $args);
		return $this->ci->renderer->render($response, '\Projects\view_projects.php', $args);
	}

	public function create_project_landing (Request $request, Response $response, $args) {
		return $this->ci->renderer->render($response, '\Projects\create_project.php', $args);
	}

	public function create_project (Request $request, Response $response, $args) {
		$ProjectModel = new \Netzwelt\Models\Projects\CreateProjectModel($this->ci);
		$success = $ProjectModel->create_project($request, $response, $args);
		if ($success)
			return $this->ci->renderer->render($response, '\Projects\create_success.php', $args);
		else
			return $this->ci->renderer->render($response, '\Projects\create_fail.php', $args);
	}

	public function assign_project_landing (Request $request, Response $response, $args) {
		$ProjectModel = new \Netzwelt\Models\Projects\AssignProjectModel($this->ci);
		$ProjectModel->assign_project_landing($request, $response, $args);
		return $this->ci->renderer->render($response, '\Projects\assign_project_landing.php', $args);
	}

	public function assign_project (Request $request, Response $response, $args) {
		$ProjectModel = new \Netzwelt\Models\Projects\AssignProjectModel($this->ci);
		return $ProjectModel->assign_project($request, $response, $args);
	}

	public function remove (Request $request, Response $response, $args) {
		$ProjectModel = new \Netzwelt\Models\Projects\AssignProjectModel($this->ci);
		return $ProjectModel->remove($request, $response, $args);
	}
}