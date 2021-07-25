<?php

namespace App\Core;

use Reflector;

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
		$this->table = strtolower(DBPREFIXE . end($getCalledClassExploded));
	}

	public function getModelName() {
			$getCalledClassExploded = explode('\\', get_called_class());
		return strtolower(end($getCalledClassExploded));
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
		
		$query = "SELECT * FROM $this->table";

		if (!empty($props)) {
			foreach ($props as $key => $value) {
				$whereConditions[] = "`$key` = '$value'";
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

		if ($data) { return $return_type_array ? $data : $this->populate($data); }
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
				$whereConditions[] = "`$key` = '$value'";
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

		if ($data) { return $return_type_array ? $data : $this->populate($data); }
		return false;
	}

	public function save() {
		// Exclude the parent properties (pdo, table) and get the child properties
		$columns = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		// Initialize a string with `fieldname` = :placeholder pairs
		$setStr = '';
		$params = [];

		// Insert if $id is null else update
		if (is_null($this->getId())) {
			$query = $this->pdo->prepare('INSERT INTO ' . strtolower($this->table) . ' (' .
				implode(',', array_keys($columns)) . ') VALUES ( :' .
				implode(',:', array_keys($columns)) . ' ); ');
			
			print_r($columns);
			$query->execute($columns);

		} else {
			$setStr = [];
			
			// Loop over source data array
			foreach (array_keys($columns) as $key) {
				// If the value is set and is not the id
				if ($key != 'id') {
					$setStr []= "`$key` = :$key";
					$params[$key] = $columns[$key];
				}
			}

			// Transform ['a=b', 'c=d'] into 'a=b, c=d'
			$setStr = implode(', ', $setStr);

			// Update row with the object ID
			$params['id'] = $this->getId();
			$this->pdo->prepare("UPDATE " . strtolower($this->table) . " SET $setStr WHERE id = :id")->execute($params);

			// TODO remove? $_SESSION['userStore'] = $this->find(['id' => $this->getId()]);
		}

	}

	public function getColumns() {
	    $query = $this->pdo->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME=?");
	    $query->bindValue(1, strtolower($this->table));
	    $query->execute();
	    $columns = $query->fetchAll(\PDO::FETCH_ASSOC);
	    return array_map(function ($col) { return $col['COLUMN_NAME']; }, $columns);
    }

	public static function getClassName($table) {
		$path = explode('\\', $table);
		return array_pop($path);
	}

	public function delete($props = []) {
		$whereClause = '';
		$whereConditions = [];
		
		$query = "DELETE FROM $this->table";

		if (!empty($props)) {
			foreach ($props as $key => $value) {
				$whereConditions[] = "`$key` = '$value'";
			}
			
			$whereClause = ' WHERE ' . implode(' AND ', $whereConditions);
		}
		
		$query = $this->pdo->query($query . $whereClause);
		$data = $query->execute();

		if ($data) { return $data; }
		return false;
	}

	public function createDatabase() {
		$dbname = "`".str_replace("`","``",DBNAME)."`";
		$this->pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
		$this->pdo->query("use $dbname");
	}

	public function createTables() {
		$this->checkIfFileTablesExist();
		$tables = $this->readTables();
		foreach ($tables as $table) {
			$fields = [];
			$tableName = $table["name"];
			$tableFields = $table["fields"];

			foreach ($tableFields as $field) {
				array_push($fields, "`" . $field['name'] . "` " . strtoupper($field['type']) . " " . implode(" ", explode('.', $field['extra'])));
			}
			$sql = "CREATE TABLE IF NOT EXISTS `". DBPREFIXE . strtolower($tableName) ."` ("
			. implode(", ", $fields) . ")";
			$query = $this->pdo->query($sql);
			$query->execute();
		}
	}

	public function createForeignKeys() {
		$file = dirname(__DIR__, 1) . '/foreignKeys.sql';
		// $str = file_get_contents($file);
		// $sql = str_replace(['DBNAME'], DBPREFIXE, $str);
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($file);
		// Loop through each line
		foreach ($lines as $line)
		{
		$line = str_replace(['DBNAME'], DBPREFIXE, $line);
		// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
				// Perform the query
				try {
					$query = $this->pdo->query($templine);
					$query->execute();
				} catch (\Exception $e) {
				}
				// Reset temp variable to empty
				$templine = '';
			}
		}
	}

	public function checkIfFileTablesExist() {
		$file = dirname(__DIR__, 1) . '/tables.json';
		if (!file_exists($file)) {
			$fh = fopen($file, 'w') or die("Erreur lors du chargement de tables.json");
			fclose($fh);
		}
		if (is_readable($file) && is_writable($file)) {
			return true;
		} else {
			die("Erreur lors de la creation des tables");
		}
	}

	public function readTables() {
		$file = dirname(__DIR__, 1) . '/tables.json';
		$str = file_get_contents($file);
		$json = json_decode($str, true);
		return $json;
	}

	// public function saveTableToJSON(array $table) {
	// 	$file = dirname(__DIR__, 1) . '/tables.json';

	// 	if ($this->checkIfFileTablesExist()) {
	// 		$fp = fopen($file, 'w+');
	// 		fwrite($fp, json_encode($table));
	// 		fclose($fp);
	// 	}
	// }

	// public function formTables() {
	// 	return [
	// 		'config'=>[
	// 			'method'=>'POST',
	// 			'action'=>'',
	// 			'id'=>'formTables',
	// 			'class'=>'form_builder',
	// 			'submit'=>'Enregistrer'
	// 		],
	// 		'inputs'=>[
	// 			'name'=>[
	// 				'type'=>'text',
	// 				'label'=>'Nom du champ',
	// 				'minLength'=>2,
	// 				'maxLength'=>255,
	// 				'id'=>'name',
	// 				'class'=>'form_input',
	// 				'error'=>'Le nom du champ doit faire entre 2 et 255 caractères',
	// 				'required'=>true
	// 			],
	// 			'type'=>[ 
	// 				'type'=>'select',
	// 				'label'=>'Type',
	// 				'id'=>'type',
	// 				'class'=>'form_input',
	// 				'options'=>['INT', 'VARCHAR', 'TEXT', 'DATE', 'DATETIME', 'TIMESTAMP', 'FLOAT', 'DOUBLE', 'LONGTEXT'],
	// 				'placeholder'=>'Séléctionnez un type',
	// 				'error'=>'Un type est obligatoire',
	// 				'required'=>true
	// 			],
	// 			'extra_options'=>[
	// 				'type'=>'select',
	// 				'label'=>'Taille/Valeurs',
	// 				'id'=>'extra_options',
	// 				'class'=>'form_input',
	// 				'options'=>['1', '2'],
	// 				'placeholder'=>'Séléctionnez un ou plusieurs paramètres',
	// 				'required'=>false
	// 			],
	// 			'extra'=>[
	// 				'type'=>'text',
	// 				'label'=>'Paramètres',
	// 				'id'=>'extra',
	// 				'class'=>'form_input',
	// 				'options'=>['PRIMARY KEY', 'NULL', 'NOT NULL', '', ''],
	// 				'placeholder'=>'Entrez la valeur par défaut',
	// 				'required'=>false
	// 			],
	// 			'default'=>[
	// 				'type'=>'text',
	// 				'label'=>'Valeur par défaut',
	// 				'id'=>'default',
	// 				'class'=>'form_input',
	// 				'options'=>['PRIMARY KEY', 'NULL', 'NOT NULL', '', ''],
	// 				'placeholder'=>'Entrez la valeur par défaut',
	// 				'required'=>false
	// 			]
	// 		]
	// 	];
	// }
}
