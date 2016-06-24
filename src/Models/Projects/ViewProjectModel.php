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

	/*
	public function view_projects (Request $request, Response $response, $args) {
		return $this->ci->renderer->render($response, '\Projects\view_projects.php', $args);
	}
	*/
}