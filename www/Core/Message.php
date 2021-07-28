<?php

namespace App\Core;

class Message {
	const CODES = [
		// SETUP
		'SETUP_STEP1_SUCCESS' => [
			'text' => 'Connexion à la base de données et création des tables réussies',
			'type' => 'success'
		],
		'SETUP_STEP1_ERROR' => [
			'text' => 'Connexion à la base de données échouée',
			'type' => 'danger'
		],
		'SETUP_STEP2_SUCCESS' => [
			'text' => 'Connexion au serveur SMTP réussie',
			'type' => 'success'
		],
		'SETUP_STEP2_ERROR' => [
			'text' => 'Connexion au serveur SMTP échouée',
			'type' => 'danger'
		],
		'SETUP_STEP3_SUCCESS' => [
			'text' => 'Inscription réussie',
			'type' => 'success'
		],
		'SETUP_STEP3_ERROR' => [
			'text' => 'Connexion réussie',
			'type' => 'danger'
		],
		// REGISTER
		'REGISTER_SUCCESS' => [
			'text' => 'Inscription réussie',
			'type' => 'success'
		],
		'LOGIN_SUCCESS' => [
			'text' => 'Connexion réussie',
			'type' => 'success'
		],
		// LOGIN
		'REGISTER_ERROR' => [
			'text' => 'Inscription échouée',
			'type' => 'danger'
		],
		'LOGIN_ERROR' => [
			'text' => 'Connexion échouée',
			'type' => 'danger'
		],
		// PROFILE
		'EDIT_PROFILE_SUCCESS' => [
			'text' => 'Modification du profil réussie<br>Redirection vers la page de connexion.',
			'type' => 'success'
		],
		'EDIT_PROFILE_ERROR' => [
			'text' => 'Modification du profil échouée',
			'type' => 'danger'
		],
		// PAGE
		'NEW_PAGE_SUCCESS' => [
			'text' => 'Création de la page réussie',
			'type' => 'success'
		],
		'NEW_PAGE_ERROR' => [
			'text' => 'Création de la page échouée',
			'type' => 'danger'
		],
		'EDIT_PAGE_SUCCESS' => [
			'text' => 'Modification de la page réussie',
			'type' => 'success'
		],
		'EDIT_PAGE_ERROR' => [
			'text' => 'Modification de la page échouée',
			'type' => 'danger'
		],
		'DELETE_PAGE_SUCCESS' => [
			'text' => 'Suppression de la page réussie',
			'type' => 'success'
		],
		'DELETE_PAGE_ERROR' => [
			'text' => 'Suppression de la page échouée',
			'type' => 'danger'
		],
		'DELETE_PAGE_SUCCESS' => [
			'text' => 'Suppression de la page réussie !',
			'type' => 'success'
		],
		'DELETE_PAGE_ERROR' => [
			'text' => 'Suppression de la page échouée !',
			'type' => 'danger'
		],
		// MENU
		'NEW_MENU_SUCCESS' => [
			'text' => 'Création du menu réussie',
			'type' => 'success'
		],
		'NEW_MENU_ERROR' => [
			'text' => 'Création du menu échouée',
			'type' => 'danger'
		],
		'EDIT_MENU_SUCCESS' => [
			'text' => 'Modification du menu réussie',
			'type' => 'success'
		],
		'EDIT_MENU_ERROR' => [
			'text' => 'Modification du menu échouée',
			'type' => 'danger'
		],
		'DELETE_MENU_SUCCESS' => [
			'text' => 'Suppression du menu réussie',
			'type' => 'success'
		],
		'DELETE_MENU_ERROR' => [
			'text' => 'Suppression du menu échouée',
			'type' => 'danger'
		],
		'DELETE_MENU_SUCCESS' => [
			'text' => 'Suppression du menu réussie !',
			'type' => 'success'
		],
		'DELETE_MENU_ERROR' => [
			'text' => 'Suppression du menu échouée !',
			'type' => 'danger'
		],
		// PRODUCT
		'NEW_PRODUCT_SUCCESS' => [
			'text' => 'Création du produit réussie',
			'type' => 'success'
		],
		'NEW_PRODUCT_ERROR' => [
			'text' => 'Création du produit échouée',
			'type' => 'danger'
		],
		'EDIT_PRODUCT_SUCCESS' => [
			'text' => 'Modification du produit réussie',
			'type' => 'success'
		],
		'EDIT_PRODUCT_ERROR' => [
			'text' => 'Modification du produit échouée',
			'type' => 'danger'
		],
		'DELETE_PRODUCT_SUCCESS' => [
			'text' => 'Suppression du produit réussie',
			'type' => 'success'
		],
		'DELETE_PRODUCT_ERROR' => [
			'text' => 'Suppression du produit échouée',
			'type' => 'danger'
		],
		'DELETE_PRODUCT_SUCCESS' => [
			'text' => 'Suppression du produit réussie !',
			'type' => 'success'
		],
		'DELETE_PRODUCT_ERROR' => [
			'text' => 'Suppression du produit échouée !',
			'type' => 'danger'
		],
		// USER
		'CREATE_USER_SUCCESS' => [
			'text' => 'Création de l\'utilisateur réussie',
			'type' => 'success'
		],
		'CREATE_USER_ERROR' => [
			'text' => 'Création de l\'utilisateur échouée',
			'type' => 'danger'
		],
		'EDIT_USER_SUCCESS' => [
			'text' => 'Mise à jour de l\'utilisateur réussie',
			'type' => 'success'
		],
		'EDIT_USER_ERROR' => [
			'text' => 'Mise à jour de l\'utilisateur échouée',
			'type' => 'danger'
		],
		'DISABLE_USER_SUCCESS' => [
			'text' => 'Désactivation du compte de l\'utilisateur réussie',
			'type' => 'success'
		],
		'DISABLE_USER_ERROR' => [
			'text' => 'Désactivation du compte de l\'utilisateur échouée',
			'type' => 'danger'
		],
		// UPLOAD
		'UPLOAD_FILE_ERROR' => [
			'text' => 'Upload de l\'image échouée',
			'type' => 'danger'
		],
		// RESET PASSWORD
		'RESET_PASSWORD_SUCCESS' => [
			'text' => 'Email de réinitialisation envoyée',
			'type' => 'success'
		],
		'RESET_PASSWORD_ERROR' => [
			'text' => 'Envoi du mail de réinitialisation échouée',
			'type' => 'danger'
		],
		// RESET PASSWORD
		'RESET_PASSWORD_SUCCESS' => [
			'text' => "Email de réinitialisation envoyée !",
			'type' => 'success'
		],
		'RESET_PASSWORD_ERROR' => [
			'text' => 'Envoi du mail de réinitialisation échouée !',
			'type' => 'danger'
		],
		// ACCOUNT
		'USER_EMAIL_ACTIVATED' => [
			'text' => 'Votre compte a été activé avec succès, vous allez être redirigé sur la page de connexion dans quelques instants',
			'type' => 'success'
		],
		'USER_VALIDATE_ACCOUNT_ERROR' => [
			'text' => 'Vous devez d\'abord valider votre email',
			'type' => 'danger'
		],
		'USER_ACCOUNT_DISABLED_EMAIL' => [
			'text' => 'Un email de verification viens de vous être envoyé, cliquez sur le lien pour supprimer votre compte',
			'type' => 'success'
		],
		'USER_ACCOUNT_DISABLED' => [
			'text' => 'Votre compte a été désactivé, il sera définitivement supprimé dans 72 heures. Redirection sur la page de connexion dans quelques instants',
			'type' => 'success'
		],
	];

	public static function add(string $code): void {
		$name = strtoupper($code);
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