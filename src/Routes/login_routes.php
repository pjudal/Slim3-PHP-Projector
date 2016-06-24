<?php

$app->get('/', 'Netzwelt\Controllers\LoginController:index_handle')
	->add(new not_logged_in());


$app->group('/secure', function () {
	$this->get('/log-out', 'Netzwelt\Controllers\LoginController:logout_landing');
	$this->get('/already-logged-in', 'Netzwelt\Controllers\LoginController:already_logged_in');
	$this->get('/log-in', 'Netzwelt\Controllers\LoginController:already_logged_in_handle')
	->add(new is_logged_in());

	$this->post('/log-in', 'Netzwelt\Controllers\LoginController:verification');
});