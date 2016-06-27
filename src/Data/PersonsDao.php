<?php

namespace Netzwelt\Data;

class PersonsDao extends BaseDao {
	public function insertPerson ($pdo, $last_name, $first_name, $username, $password) {
		$stmt = $pdo->prepare("INSERT INTO persons
				(last_name,
				first_name,
				username,
				password)
			VALUES
				(?,
				?,
				?,
				?)");
		try {
			$stmt->execute([$last_name, $first_name, $username, $password]);
			return 1;
		} catch(\PDOException $e) {
			return 0;
		}
	}
}