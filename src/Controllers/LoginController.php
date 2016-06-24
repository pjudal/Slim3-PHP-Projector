<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Controllers;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginController {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
		$this->LoginModel = new \Netzwelt\Models\Login\LoginModel($this->ci);
	}

	public function already_logged_in_handle (Request $request, Response $response, $args) {
		return $this->ci->renderer->render($response, '\Login\login_landing.php', $args);
	}

	public function index_handle (Request $request, Response $response, $args) {
		return $this->ci->renderer->render($response, '\Projects\view_projects.php', $args);
	}

	public function verification (Request $request, Response $response, $args) {
		$success =  $this->LoginModel->verification($request, $response, $args);
		if ($success)	return $response->withRedirect("/projects", 200);
		else	return $this->ci->renderer->render($response, '\Login\login_failed.php', $args);
	}

	public function logout_landing (Request $request, Response $response, $args) {
		return $this->LoginModel->logout_landing($request, $response, $args);
	}
	public function already_logged_in (Request $request, Response $response, $args) {
		return $this->ci->renderer->render($response, '\Login\already_logged_in.php', $args);
	}
}