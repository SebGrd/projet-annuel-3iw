<?php

namespace App\Core;

class Message {
	const CODES = [
		// REGISTER
		'REGISTER_SUCCESS' => [
			'text' => 'Inscription réussie !',
			'type' => 'success'
		],
		'LOGIN_SUCCESS' => [
			'text' => 'Connexion réussie !',
			'type' => 'success'
		],
		// LOGIN
		'REGISTER_ERROR' => [
			'text' => 'Inscription échouée !',
			'type' => 'danger'
		],
		'LOGIN_ERROR' => [
			'text' => 'Connexion échouée !',
			'type' => 'danger'
		],
		// PROFILE
		'EDIT_PROFILE_SUCCESS' => [
			'text' => 'Modification du profil réussie !<br>Redirection vers la page de connexion.',
			'type' => 'success'
		],
		'EDIT_PROFILE_ERROR' => [
			'text' => 'Modification du profil échouée !',
			'type' => 'danger'
		],
		// PAGE
		'PAGE_SUCCESS' => [
			'text' => 'Création de la page réussie !',
			'type' => 'success'
		],
		'PAGE_ERROR' => [
			'text' => 'Création de la page échouée !',
			'type' => 'danger'
		],
		'EDIT_PAGE_SUCCESS' => [
			'text' => 'Modification de la page réussie !',
			'type' => 'success'
		],
		'EDIT_PAGE_ERROR' => [
			'text' => 'Modification de la page échouée !',
			'type' => 'danger'
		],
		// MENU
		'MENU_SUCCESS' => [
			'text' => 'Création du menu réussie !',
			'type' => 'success'
		],
		'MENU_ERROR' => [
			'text' => 'Création du menu échouée !',
			'type' => 'danger'
		],
		'EDIT_MENU_SUCCESS' => [
			'text' => 'Modification du menu réussie !',
			'type' => 'success'
		],
		'EDIT_MENU_ERROR' => [
			'text' => 'Modification du menu échouée !',
			'type' => 'danger'
		],
		// PRODUCT
		'PRODUCT_SUCCESS' => [
			'text' => 'Création du produit réussie !',
			'type' => 'success'
		],
		'PRODUCT_ERROR' => [
			'text' => 'Création du produit échouée !',
			'type' => 'danger'
		],
		'EDIT_PRODUCT_SUCCESS' => [
			'text' => 'Modification du produit réussie !',
			'type' => 'success'
		],
		'EDIT_PRODUCT_ERROR' => [
			'text' => 'Modification du produit échouée !',
			'type' => 'danger'
		]
	];

	public static function add(string $code): void {
		$name = strtolower($code);
		// If the message code exists
		if (isset(self::CODES[$code])) {
			// Extract it after storing it in a variable (or else an error occurs)
			$arr = self::CODES[$code];
			extract($arr);

			// Create the session message
			Session::create($name, ['text' => $text, 'class' => "text-$type"]);
		} else {
			Session::create($name, ['text' => 'Erreur interne', 'class' => 'text-danger']);
		}
    }
}