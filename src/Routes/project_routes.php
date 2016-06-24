<?php

$app->group('/projects', function () {
	$this->get('', 'Netzwelt\Controllers\ProjectsController:view_projects')
		->add(new not_logged_in());

	$this->group('/create', function() {
		$this->get('', 'Netzwelt\Controllers\ProjectsController:create_project_landing')
			->add(new not_logged_in());
		$this->post('', 'Netzwelt\Controllers\ProjectsController:create_project')
			->add(new not_logged_in());
	});
	

	$this->group('/assign', function() {
		$this->get('', 'Netzwelt\Controllers\ProjectsController:assign_project_landing')
			->add(new not_logged_in());
		$this->post('', 'Netzwelt\Controllers\ProjectsController:assign_project')
			->add(new not_logged_in());
		$this->post('/remove', 'Netzwelt\Controllers\ProjectsController:remove')
			->add(new not_logged_in());
	});
});