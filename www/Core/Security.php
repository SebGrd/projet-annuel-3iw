<?php

namespace App\Core;
use App\Core\JWT\JwtHandler;

class Security {

	public static function isConnected() {
		if (isset($_COOKIE["token"])) {
			$jwt = new JwtHandler();
			$data = $jwt->_jwt_decode_data(trim($_COOKIE["token"]));
			var_dump($data);
			if (is_object($data)) return true;
		}
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

}