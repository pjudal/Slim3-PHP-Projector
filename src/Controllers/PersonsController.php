<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Controllers;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class PersonsController {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

	public function create_person_landing (Request $request, Response $response, $args) {
		return $this->ci->renderer->render($response, '\Persons\create_person.php', $args);
	}

	public function create_person (Request $request, Response $response, $args) {
		$PersonModel = new \Netzwelt\Models\Persons\CreatePersonModel($this->ci);
		$success = $PersonModel->create_person($request, $response, $args);
		if ($success)
			return $this->ci->renderer->render($response, '\Persons\create_success.php', $args);
		return $this->ci->renderer->render($response, '\Persons\create_fail.php', $args);
	}
}