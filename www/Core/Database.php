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
			// Unsafe -> Replace $message with a generic error message
			die('SQL error: ' . $e->getMessage());
		}

		$getCalledClassExploded = explode('\\', get_called_class());
		$this->table = DBPREFIXE . end($getCalledClassExploded);
	}

	public function populate($arr) {
		$obj = get_class($this)();

		foreach ($arr as $key => $value) {
			$obj->$key = $value;
		}

		return $obj;
	}

	public function find($props = [], $order = [], $return_type_array = true) {
		$result = [];
		$whereClause = '';
		$whereConditions = [];
		
		$orderClause = '';
		$orderConditions = [];
		
		$query = "SELECT * FROM " . strtolower($this->table);

		if (!empty($props)) {
			foreach ($props as $key => $value) {
				$whereConditions[] = '`' . $key . '` = "' . $value . '"';
			}
			
			$whereClause = ' WHERE ' . implode(' AND ', $whereConditions);
		}
		
		if (!empty($order) or !is_null($order)) {
			foreach ($order as $key => $value) {
				$orderConditions[] = "$key " . strtoupper($value);
			}
			
			$orderClause = ' ORDER BY ' . implode(', ', $orderConditions);
		}
		
		$query = $this->pdo->query($query . $whereClause . (!empty($order) ? $orderClause : ''));
		$query->execute();
		$data = $query->fetch(\PDO::FETCH_ASSOC);

		if ($data) {
			return $return_type_array ? $data : $this->populate($data);
		}
		return false;
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

		} else {
			// TODO add UPDATE
		}

		$query->execute($columns);
	}

	// public function select(array $cols) {
	// 	var_dump(array_keys($cols));
	// 	echo('colmns' . $cols);
	// 	$query = $this->pdo->prepare('SELECT FROM ' . strtolower($this->table) . ' (' .
	// 	implode(',', array_keys($cols))
	// 	. ');');
	// 	echo('qry' . $query);
	// 	$query->execute($cols);
	// }
}
