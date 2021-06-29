<?php

namespace App\Core;

class FormValidator {
	public static function check($form, $data) {
		$errors = [];

		if (count($data) == count($form['inputs'])) {
			foreach ($form['inputs'] as $name => $configInput) {
				if (!$configInput['required'] && strlen($data[$name]) == 0) {
					continue;
				}
				if (!empty($configInput['minLength']) &&
					is_numeric($configInput['minLength']) &&
					strlen($data[$name]) < $configInput['minLength']) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['confirm']) &&
					($data[$name]) !== $data[$configInput['confirm']]) {
					$errors[] = $configInput['error'];
				}
			}
		} else {
			$errors[] = 'Hacking detected';
		}

		return $errors;
	}
}