<?php

//to access items in the container... $this->ci->get('');

namespace Netzwelt\Models\Login;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginModel {
	protected $ci;
	//Constructor
	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

	public function verification (Request $request, Response $response, $args) {	
		$email = $_POST["email"];
		$pass =  $_POST["pass"];
		
		// Validate sign-in details

		// Constraint boolean status
		$email_format = 0;
		$email_length = 0;
		$pass_length = 0;
		$valid_email = 0;
		$valid_pass = 0;

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$email_format = 1;
		}
		else {
			$email_format = 0;
		}

		if (strlen($email) >= 5 AND strlen($email) <= 200) {
			$email_length = 1;
		}
		else {
			$email_length = 0;
		}

		if (strlen($pass) >= 7 AND strlen($pass) <= 11) {
			$pass_length = 1;
		}
		else {
			$pass_length = 0;
		}


		//Check if e-mail and password match something in the database

		// Create connection
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


		// Check if e-mail exists in the database
		$stmt = $conn->prepare("SELECT EXISTS(SELECT 1 FROM persons WHERE username=?)");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();

		while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
            	if ($r == 1)	$valid_email = 1;
            	else	$valid_email = 0;
            }
        }

        // If e-mail exists, check if the supplied password corresponds that which is in the database
        if ($valid_email == 1) {
        	$stmt = $conn->prepare("SELECT EXISTS(SELECT 1 FROM persons WHERE username=? AND password=?)");
        	$stmt->bind_param("ss", $email, $pass);
        	$stmt->execute();
        	$result = $stmt->get_result();

			while ($row = $result->fetch_array(MYSQLI_NUM))
	        {
	            foreach ($row as $r)
	            {
	            	if ($r == 1)	$valid_pass = 1;
	            	else	$valid_pass = 0;
	            }
	        }
        }


		// If all log-in requirements are met, set current_user session variable,
		// and tell controller to render projects page.
		if ($email_format == 1 AND $email_length == 1 AND $pass_length == 1
			AND $valid_email == 1 AND $valid_pass == 1) {

        	$stmt = $conn->prepare("SELECT first_name FROM persons WHERE username=? AND password=?");
        	$stmt->bind_param("ss", $email, $pass);
        	$stmt->execute();
        	$result = $stmt->get_result();

			while ($row = $result->fetch_array(MYSQLI_NUM))
	        {
	            foreach ($row as $r)
	            {
	            	$first_name = ucwords($r);
	            	$_SESSION["current_user"] = $first_name;
	            }
	        }
			return TRUE;
		}
		

		// Otherwise, tell controller to render login_failed page.
		else {
			$args["valid_email"] = $valid_email;
			$args["valid_pass"] = $valid_pass;
			$args["email_format"] = $email_format;
			$args["email_length"] = $email_length;
			$args["pass_length"] = $pass_length;
			$_SESSION["args"] = $args;
			return FALSE;
		}
	}

	public function logout_landing (Request $request, Response $response, $args) {
		unset($_SESSION["current_user"]);
		return $response->withRedirect("/secure/log-in", 200);
	}
}