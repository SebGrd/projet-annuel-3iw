<?php

use App\Core\Helpers;
namespace App\Core;

class FormValidator {
	public static function check($form, $data) {
		$errors = [];

		// if (count($data) == count($form['inputs'])) {
			foreach ($form['inputs'] as $name => $configInput) {
				if (!$configInput['required'] && isset($data[$name]) && strlen($data[$name]) == '') {
					continue;
				}
				if (!empty($configInput['minLength']) &&
					is_numeric($configInput['minLength']) &&
					strlen($data[$name]) < $configInput['minLength']) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['maxLength']) &&
					is_numeric($configInput['maxLength']) &&
					strlen($data[$name]) > $configInput['maxLength']) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['min']) &&
					is_numeric($configInput['min']) &&
					strlen($data[$name]) < $configInput['min']) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['max']) &&
					is_numeric($configInput['max']) &&
					strlen($data[$name]) > $configInput['max']) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['confirm']) &&
					($data[$name]) !== $data[$configInput['confirm']]) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['type']) &&
				$configInput['type'] === 'numeric' &&
				(!is_numeric($data[$name]) || abs($data[$name]) > $data[$name])) {
					$errors[] = $configInput['error'];
				}
				if (!empty($configInput['type']) &&
				$configInput['type'] === 'decimal' &&
				!is_numeric(Helpers::tofloat($data[$name]))) {
					$errors[] = $configInput['error'];
				}
			}
		// } else {
		// 	$errors[] = 'Erreur inconnue';
		// }

		return $errors;
	}
}