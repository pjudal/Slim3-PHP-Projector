<?php

namespace Netzwelt\Data;

class ProjectsDao extends BaseDao {
	public function isEmpty ($pdo) {
		$stmt = $pdo->prepare("SELECT EXISTS(SELECT 1 FROM projects)");
		$stmt->execute();
		$isEmpty = $stmt->fetch();
		foreach ($isEmpty as $row) {
			return $row;
		}
	}

	public function selectProjects($pdo) {
		$projects = [];
		$stmt = $pdo->prepare("SELECT * FROM projects");
		$stmt->execute();
		while ($row = $stmt->fetch()) {
		    array_push($projects, $row);
		}
		return $projects;
	}

	public function selectID ($pdo, $code) {
		$stmt = $pdo->prepare("SELECT id FROM projects WHERE code=?");
		$stmt->execute([$code]);
		$result = $stmt->fetch();
		foreach ($result as $row) {
			return $row;
		}
	}

	public function selectName ($pdo, $code) {
		$stmt = $pdo->prepare("SELECT name FROM projects WHERE code=?");
		$stmt->execute([$code]);
		$result = $stmt->fetch();
		foreach ($result as $row) {
			return $row;
		}
	}	

	public function insertProject ($pdo, $code, $name, $remarks, $budget) {
		$stmt = $pdo->prepare("INSERT INTO projects
				(code,
				name,
				remarks,
				budget)
			VALUES
				(?, ?, ?, ?)");
		try {
			$stmt->execute([$code, $name, $remarks, $budget]);
			return 1;
		} catch(\PDOException $e) {
			return 0;
		}
	}

	public function insertProjectAssignment ($pdo, $person_id, $project_id) {
		$stmt = $pdo->prepare("INSERT INTO projectassignments (person_id, project_id)
			VALUES (?, ?)");
		try {
			$stmt->execute([$person_id, $project_id]);
			return 1;
		} catch(\PDOException $e) {
			return 0;
		}
	}

	public function returnUnassigned ($pdo, $code) {
		$unassigned = [];
		$stmt = $pdo->prepare("SELECT * FROM persons WHERE persons.id NOT IN
			(SELECT person_id FROM projectassignments WHERE project_id=
				(SELECT id FROM projects WHERE code=?))");
		$stmt->execute([$code]);
		while ($row = $stmt->fetch()) {
		    array_push($unassigned, $row);
		}
		return $unassigned;
	}

	public function returnUnassignedID ($pdo, $id) {
		$unassigned = [];
		$stmt = $pdo->prepare("SELECT * FROM persons WHERE persons.id NOT IN
			(SELECT person_id FROM projectassignments WHERE project_id=?)");
		$stmt->execute([$id]);
		while ($row = $stmt->fetch()) {
		    array_push($unassigned, $row);
		}
		return $unassigned;
	}

	public function returnAssigned ($pdo, $code) {
		$assigned = [];
		$stmt = $pdo->prepare("SELECT * FROM persons WHERE persons.id IN
			(SELECT person_id FROM projectassignments WHERE project_id=
				(SELECT id FROM projects WHERE code=?))");
		$stmt->execute([$code]);
		while ($row = $stmt->fetch()) {
		    array_push($assigned, $row);
		}
		return $assigned;
	}

	public function returnAssignedID ($pdo, $id) {
		$assigned = [];
		$stmt = $pdo->prepare("SELECT * FROM persons WHERE persons.id IN
			(SELECT person_id FROM projectassignments WHERE project_id=?)");
		$stmt->execute([$id]);
		while ($row = $stmt->fetch()) {
		    array_push($assigned, $row);
		}
		return $assigned;
	}

	

	public function deleteProjectAssignment ($pdo, $person_id, $project_id) {
		$stmt = $pdo->prepare("DELETE FROM projectassignments WHERE person_id=? AND project_id=?");
		try {
			$stmt->execute([$person_id, $project_id]);
			return 1;
		} catch(\PDOException $e) {
			return 0;
		}
	}
}