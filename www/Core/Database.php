<?php

namespace App\Core;

class Database {
	private $pdo;
	private $table;

	public function __construct() {
		try {
			// FIXME #1: SQLSTATE[HY000] [2002] Connection timed out
			$this->pdo = new \PDO(DBDRIVER . ':dbname=' . DBNAME . ';host=' . DBHOST . ';port=' . DBPORT, DBUSER, DBPWD);

			if (ENV == 'dev') {
				$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			}
		} catch (\Exception $e) {
			die('SQL error: ' . $e->getMessage());
		}

		$getCalledClassExploded = explode('\\', get_called_class());
		$this->table = DBPREFIXE . end($getCalledClassExploded);
	}

	public function save() {
		$columns = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		// Insert if $id is null else update
		if (is_null($this->getId())) {
			$query = $this->pdo->prepare('INSERT INTO ' . strtolower($this->table) . ' (' .
				implode(',', array_keys($columns))
				. ') 
				VALUES ( :' .
				implode(',:', array_keys($columns))
				. ' );');

			var_dump($query);
		} else {
			// TODO add UPDATE
		}

		$query->execute($columns);
	}
}