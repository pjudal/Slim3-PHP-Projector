<?php

namespace Netzwelt\Data;

class LoginDao extends BaseDao {
	public function emailExists ($pdo, $email) {
		$stmt = $pdo->prepare("SELECT EXISTS(SELECT 1 FROM persons WHERE username=?)");
		$stmt->execute([$email]);
		$exists = $stmt->fetch();
		foreach ($exists as $row) {
			return $row;
		}
	}

	public function emailPassMatch ($pdo, $email, $password) {
		$stmt = $pdo->prepare("SELECT EXISTS(SELECT 1 FROM persons WHERE username=? AND password=?)");
		$stmt->execute([$email, $password]);
		$match = $stmt->fetch();
		foreach ($match as $row) {
			return $row;
		}
	}

	public function selectFirstName ($pdo, $email, $password) {
		$stmt = $pdo->prepare("SELECT first_name FROM persons WHERE username=? AND password=?");
		$stmt->execute([$email, $password]);
		$first_name = $stmt->fetch();
		foreach ($first_name as $row) {
		    return $row;
		}
	}
}