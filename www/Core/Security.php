<?php

namespace App\Core;
use App\Core\JWT\JwtHandler;

class Security {

	public static function isConnected() {
		if (isset($_COOKIE["token"])) {
			$jwt = new JwtHandler();
			$data = $jwt->_jwt_decode_data(trim($_COOKIE["token"]));
			if (is_object($data)) {
				$_SESSION['userStore'] = $data->data;
				return true;
			} else {
				$_SESSION['userStore'] = null;
				return false;
			}
		}
			$_SESSION['userStore'] = null;
		return false;
	}

	public static function createJwt(array $data) {
		$jwt = new JwtHandler();
		$token = $jwt->_jwt_encode_data(
			'http://localhost/',
			$data
		);
		return $token;
	}

	public static function decodeJwt($token) {
		$jwt = new JwtHandler();
		$data =  $jwt->_jwt_decode_data(trim($token));
		return $data;
	}

	public static function isAuthorized(array $access) {

		$role = (isset($_SESSION['userStore']) ? get_object_vars($_SESSION['userStore'])['role'] : 'guest');
		
		return in_array($role, $access);
	}
}