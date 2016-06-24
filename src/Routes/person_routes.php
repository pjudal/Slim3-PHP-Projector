<?php

$app->group('/persons', function () {
	$this->get('/create', 'Netzwelt\Controllers\PersonsController:create_person_landing')
		->add(new not_logged_in());
	$this->post('/create', 'Netzwelt\Controllers\PersonsController:create_person')
		->add(new not_logged_in());
});