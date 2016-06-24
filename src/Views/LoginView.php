<?php

namespace Netzwelt\Views;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginView {

	protected $ci;
	public $projects = [];
	public function __construct(Container $ci) {
		$this->ci = $ci;
		$this->LoginModel = new \Netzwelt\Models\Login\LoginModel($this->ci);
	}

	public function initialize($args) {
		// init database
		$projectDao = new ProjectDao($this->container['settings']);
		// fetch projects
		$this->projects = $projectDao->getProjects($args);
		return $this;
	}

	

}