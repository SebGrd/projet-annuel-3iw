<?php

namespace App\Models;

use App\Core\Database;

class User extends Database {
	private $id = null;
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $pwd;
	protected $pwdResetToken;
	protected $country = 'fr';
	protected $role = 0;
	protected $status = 0;
	protected $isDeleted = 0;
	protected $createdAt = null;
	protected $updatedAt = null;

	public function __construct(){
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param null $id
	 */
	public function setId($id) {
		$this->id = $id;
		// double action de peupler l'objet avec ce qu'il y a en bdd
		// https://www.php.net/manual/fr/pdostatement.fetch.php
	}

	/**
	 * @return mixed
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * @return mixed
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * @param mixed $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getPwd() {
		return $this->pwd;
	}

	/**
	 * @param mixed $pwd
	 */
	public function setPwd($pwd) {
		$this->pwd = $pwd;
	}

	/**
	 * @return string
	 */
	public function getCountry(): string {
		return $this->country;
	}

	/**
	 * @param string $country
	 */
	public function setCountry(string $country) {
		$this->country = $country;
	}

	/**
	 * @return int
	 */
	public function getStatus(): int {
		return $this->status;
	}

	/**
	 * @param int $status
	 */
	public function setStatus(int $status) {
		$this->status = $status;
	}

	/**
	 * @return int
	 */
	public function getIsDeleted(): int {
		return $this->isDeleted;
	}

	/**
	 * @param int $idDeleted
	 */
	public function setIsDeleted(int $isDeleted) {
		$this->isDeleted = $isDeleted;
	}

	/**
	 * @return string
	 */
	public function getRole(): string {
		return $this->role;
	}

	/**
	 * @param string $role
	 */
	public function setRole(string $role) {
		$this->role = $role;
	}

	/**
	 * @return string
	 */
	public function getPwdResetToken(): string {
		return $this->pwdResetToken;
	}

	/**
	 * @param string $pwdResetToken
	 */
	public function setPwdResetToken(string $pwdResetToken) {
		$this->pwdResetToken = $pwdResetToken;
	}

	/**
	 * @return string
	 */
	public function getCreatedAt(): string {
		return $this->createdAt;
	}

	/**
	 * @param string $createdAt
	 */
	public function setCreatedAt(string $createdAt) {
		$this->createdAt = $createdAt;
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt(): string {
		return $this->updatedAt;
	}

	/**
	 * @param string $updatedAt
	 */
	public function setUpdatedAt(string $updatedAt) {
		$this->updatedAt = $updatedAt;
	}

	public function formRegister() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_register',
				'class'=>'form',
				'submit'=>"S'inscrire"
			],
			'inputs'=>[
				'firstname'=>[ 
					'type'=>'text',
					'label'=>'Votre prénom',
					'minLength'=>2,
					'maxLength'=>55,
					'id'=>'firstname',
					'class'=>'form_input',
					'placeholder'=>'Exemple: Yves',
					'error'=>'Votre prénom doit faire entre 2 et 55 caractères',
					'required'=>true
				],
				'lastname'=>[ 
					'type'=>'text',
					'label'=>'Votre nom',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'lastname',
					'class'=>'form_input',
					'placeholder'=>'Exemple: SKRZYPCZYK',
					'error'=>'Votre nom doit faire entre 2 et 255 caractères',
					'required'=>true
				],
				'email'=>[ 
					'type'=>'email',
					'label'=>'Votre email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'Exemple: nom@gmail.com',
					'error'=>'Votre email doit faire entre 8 et 320 caractères',
					'required'=>true
				],
				'pwd'=>[ 
					'type'=>'password',
					'label'=>'Votre mot de passe',
					'minLength'=>8,
					'id'=>'pwd',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre mot de passe doit faire au minimum 8 caractères',
					'required'=>true
				],
				'pwdConfirm'=>[ 
					'type'=>'password',
					'label'=>'Confirmation',
					'confirm'=>'pwd',
					'id'=>'pwdConfirm',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre mot de mot de passe de confirmation ne correspond pas',
					'required'=>true
				],
				'country'=>[ 
					'type'=>'select',
					'label'=>'Votre pays',
					'options' => [ 
						'fr'=>'France',
						'en'=>'Royaume-Uni',
						'ru'=>'Russie',
						'pl'=>'Pologne',
					],
					'minLength'=>2,
					'maxLength'=>2,
					'id'=>'country',
					'class'=>'form_input',
					'placeholder'=>'Exemple: fr',
					'error'=>'Votre pays doit faire 2 caractères'
				]
			]
		];
	}

	public function formLogin() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_login',
				'class'=>'form',
				'submit'=>'Se connecter'
			],
			'inputs'=>[
				'email'=>[
					'type'=>'email',
					'label'=>'Votre email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'Exemple: nom@gmail.com',
					'error'=>'Votre email doit faire entre 8 et 320 caractères',
					'required'=>true
				],
				'pwd'=>[ 
					'type'=>'password',
					'label'=>'Votre mot de passe',
					'minLength'=>8,
					'id'=>'pwd',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre mot de passe doit faire au minimum 8 caractères',
					'required'=>true
				]
			]
		];
	}

	public function formResetPassword() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_reset_password',
				'class'=>'form_builder',
				'submit'=>'Obtenir un nouveau mot de passe'
			],
			'inputs'=>[
				'email'=>[ 
					'type'=>'email',
					'label'=>'Votre email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre email doit faire entre 8 et 320 caractères',
					'required'=>true
				]
			]
		];
	}

	public function formNewPassword() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'formNewPassword',
				'class'=>'form_builder',
				'submit'=>'Enregistrer'
			],
			'inputs'=>[
				'pwd'=>[
					'type'=>'password',
					'label'=>'Votre nouveau mot de passe',
					'minLength'=>8,
					'id'=>'pwd',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre mot de passe doit faire au minimum 8 caractères',
					'required'=>true
				],
				'pwdConfirm'=>[
					'type'=>'password',
					'label'=>'Confirmation du mot de passe',
					'confirm'=>'pwd',
					'id'=>'pwdConfirm',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre mot de mot de passe de confirmation ne correspond pas',
					'required'=>true
				]
			]
		];
	}
}