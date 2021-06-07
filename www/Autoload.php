<?php

namespace App;

class Autoload {
	public static function register() {
		spl_autoload_register(function($class) {
			$class = str_ireplace(__NAMESPACE__, '', $class);
			$class = ltrim($class, '\\');
			$class = str_replace('\\', '/', $class);
		
			if (file_exists("$class.php")) {
				include "$class.php";
			}
		});
	}
}