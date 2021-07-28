<?php

namespace App\Core;

class ConstantMaker {
	private $envPath = '.env';
	private $data = [];

	public function __construct() {
		if (!file_exists($this->envPath)) {
			$envs = ['DBDRIVER'=>'mysql', 'ENV'=>'prod'];
			$file = dirname(__DIR__, 1) . '/.env';
			$fp = fopen($file, 'a+');
			foreach ($envs as $key => $env) {
				fwrite($fp, $key . '=' . $env . "\n");
			}
			fwrite($fp, "\n");
			fclose($fp);
			// die("Environment file {$this->envPath} not found");
		}

		// .env
		$this->parseEnv($this->envPath);

		if (!empty($this->data['ENV'])) {
			// .env.prod ou .env.dev
			$this->parseEnv($this->envPath.'.'.$this->data['ENV']);
		}
		date_default_timezone_set( "Europe/Paris" );
		$this->defineConstants();
	}

	public function defineConstants() {
		foreach ($this->data as $key => $value) {
			self::defineConstant($key, $value);
		}
	}

	public static function defineConstant($key, $value) {
		$key = str_replace(' ', '_', mb_strtoupper(trim($key)));
		if (!defined($key)) {
			define($key, $value);
		}
	}

	public function parseEnv($file) {
		if (file_exists($file)) {
			$handle = fopen($file, 'r');
			if (!empty($handle)) {
				while (!feof($handle)) {
					$line = trim(fgets($handle));
					preg_match('/([^=]*)=([^#]*)/', $line, $results);
					if (!empty($results[1]) && !empty($results[2])) {
						$this->data[$results[1]] = trim($results[2]);
					}
				}
			}
		}
	}
}
