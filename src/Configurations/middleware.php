<?php
// Application middleware

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// If you are not logged in, redirect to log-in page - otherwise continue.
class not_logged_in {
	public function __invoke (Request $request, Response $response, $next) {
		if (isset($_SESSION["current_user"]) == false) {
			return $response->withRedirect("/secure/log-in", 401);
		}
		else {
			$response = $next($request, $response);
			return $response;
		}
	}
}

// If you are logged in, redirect to log-in page - otherwise continue.
class is_logged_in {
	public function __invoke (Request $request, Response $response, $next) {
		if (isset($_SESSION["current_user"]) == true) {
			return $response->withRedirect("/secure/already-logged-in", 401);
		}
		else {
			$response = $next($request, $response);
			return $response;
		}
	}
}