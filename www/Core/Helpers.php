<?php

namespace App\Core;
use App\Core\View;

class Helpers {
	public static function clearLastname($lastname) {
		return mb_strtoupper(trim($lastname));
	}

	public static function render($view) {
		$view = str_replace('.', '/', $view);
		include "Views/$view.view.php";
		// $view = new View($view, $template ?? 'front');
	}

	public static function v($view) {
		$view = str_replace('.', '/', $view);
		// include "Views/$view.view.php";
		$view = new View($view, $template ?? 'front');
	}

	public static function dump($dump) {
		echo '<pre>' . print_r($dump) . '</pre>';
	}
	
	public static function err($errors) {
		$var = '';
		foreach ($errors as $error) {
			$var .= "<li style='color: red;'>$error</li>";
		}
		return $var;
	}
}