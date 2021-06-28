<?php

namespace App\Core;

class Helpers {
	public static function clearLastname($lastname) {
		return mb_strtoupper(trim($lastname));
	}

	public static function render($view) {
		$view = str_replace('.', '/', $view);
		include "Views/$view.view.php";
	}

	public static function dump($dump) {
		echo '<pre>' . print_r($dump) . '</pre>';
	}
	
	public static function error($message) {
		echo <<< HTML
			<div class="error-msg">
				<span class="error-text">Erreur : '.message.'</span>
			</div>
HTML;
		die();
	}
}