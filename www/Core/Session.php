<?php

namespace App\Core;

class Session {
	public static function create($name, $value) {
		if (session_status() == PHP_SESSION_DISABLED) { session_start(); }
		$_SESSION[$name] = $value;
	}

	public static function destroy($name) {
		$_SESSION[$name] = null;
	}

	public static function load($name) {
		return $_SESSION[$name];
	}

	public static function flash($name) {
		$session = $_SESSION[$name] ?? [];
		unset($_SESSION[$name]);
		return $session;
	}

	public static function exist($name) {
		return isset($_SESSION[$name]);
	}
}