<?php

namespace App\Core;

use App\Models\User;
use App\Models\Menu;

class Database {
	private $pdo;
	private $table;

	public function __construct() {
		try {
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
		foreach ($arr as $key => $value) {
			if (!in_array($key, ['pdo', 'table'])) {
				$setter = 'set'.ucwords($key);
				$this->$setter($arr[$key]);
			} else if ($key === 'updateAt') {
				$setter = 'set'.ucwords($key);
				$this->$setter(date('Y-m-d h:i:s'));
			}
		}
		return $this;
	}

	public function find($props = [], $order = [], $return_type_array = false) {
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

	public function findAll($props = [], $order = [], $return_type_array = false) {
		$whereClause = '';
		$whereConditions = [];
		
		$orderClause = '';
		$orderConditions = [];
		$class = "App\Models\\" . $this->getClassName(get_class($this));
		
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
		$data = $query->fetchAll(\PDO::FETCH_CLASS, $class);

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
		$params = [];
		// initialize a string with `fieldname` = :placeholder pairs
		$setStr = "";

		// Insert if $id is null else update
		if (is_null($this->getId())) {
			$query = $this->pdo->prepare('INSERT INTO ' . strtolower($this->table) . ' (' .
				implode(',', array_keys($columns)) . ') VALUES ( :' .
				implode(',:', array_keys($columns)) . ' ); ');
			
			$query->execute($columns);

		} else {
			$setStr = [];
			// loop over source data array
			foreach (array_keys($columns) as $key)
			{
				if (isset($_POST[$key]) && $key != "id")
				{
					$setStr []= "`$key` = :$key";
					$params[$key] = $columns[$key];
				}
			}

			$params['id'] = $this->getId();
			$ok = $this->pdo->prepare("UPDATE " . strtolower($this->table) . " SET ".implode(",", $setStr)." WHERE id = :id")->execute($params);
		}

	}

	public static function getClassName($table) {
    $path = explode('\\', $table);
    return array_pop($path);
	}

	public function delete($props = []) {
		$whereClause = '';
		$whereConditions = [];
		
		$query = "DELETE FROM " . strtolower($this->table);

		if (!empty($props)) {
			foreach ($props as $key => $value) {
				$whereConditions[] = '`' . $key . '` = "' . $value . '"';
			}
			
			$whereClause = ' WHERE ' . implode(' AND ', $whereConditions);
		}
		
		$query = $this->pdo->query($query . $whereClause);
		$data = $query->execute();

		if ($data) {
			return $data;
		}
		return false;
	}

}
