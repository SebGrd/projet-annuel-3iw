<?php

namespace App\Models;

use App\Core\Database;

class User extends Database {
	private $id = null;
	protected $avatar = null;
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $pwd;
	protected $pwdResetToken = '';
	protected $role = 'user';
	protected $status = 0;
	protected $isDeleted = 0;
	protected $createdAt = '';
	protected $updatedAt = '';

	public function __construct(){
		parent::__construct();
		if ($this->id == null) {
			$this->setCreatedAt();
		}
	$this->setUpdatedAt();
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
	public function setCreatedAt() {
		$this->createdAt = date('Y-m-d H:i:s');
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
	public function setUpdatedAt() {
		$this->updatedAt = date('Y-m-d H:i:s');
	}

	/**
	 * @return mixed
	 */
	public function getAvatar() {
		return $this->avatar;
	}

	/**
	 * @param mixed $avatar
	 */
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
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
					'label'=>'Prénom',
					'minLength'=>2,
					'maxLength'=>55,
					'id'=>'firstname',
					'class'=>'form_input',
					'placeholder'=>'Ex : John',
					'error'=>'Votre prénom doit faire entre 2 et 55 caractères',
					'required'=>true
				],
				'lastname'=>[ 
					'type'=>'text',
					'label'=>'Nom',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'lastname',
					'class'=>'form_input',
					'placeholder'=>'Ex : DOE',
					'error'=>'Votre nom doit faire entre 2 et 255 caractères',
					'required'=>true
				],
				'email'=>[ 
					'type'=>'email',
					'label'=>'Email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'Ex : john.doe@gmail.com',
					'error'=>'Votre email doit faire entre 8 et 320 caractères',
					'required'=>true
				],
				'pwd'=>[ 
					'type'=>'password',
					'label'=>'Mot de passe',
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
					'error'=>'Les mot de passe ne correspondent pas',
					'required'=>true
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
					'label'=>'Email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'Ex : john.doe@gmail.com',
					'error'=>'Votre email doit faire entre 8 et 320 caractères',
					'required'=>true
				],
				'pwd'=>[ 
					'type'=>'password',
					'label'=>'Mot de passe',
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
					'label'=>'Email',
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
					'label'=>'Nouveau mot de passe',
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

	public function formEditProfile() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'formProfile',
				'class'=>'form_builder',
				'submit'=>'Enregistrer',
				'enctype'=>'multipart/form-data'
			],
			'inputs'=>[
				'firstname'=>[ 
					'type'=>'text',
					'label'=>'Prénom',
					'minLength'=>2,
					'maxLength'=>55,
					'id'=>'firstname',
					'class'=>'form_input',
					'placeholder'=>'Ex : John',
					'error'=>'Votre prénom doit faire entre 2 et 55 caractères',
					'value'=>$_SESSION['userStore']->firstname ?? '',
					'required'=>true
				],
				'lastname'=>[ 
					'type'=>'text',
					'label'=>'Nom de famille',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'lastname',
					'class'=>'form_input',
					'placeholder'=>'Ex : DOE',
					'error'=>'Votre nom de famille doit faire entre 2 et 255 caractères',
					'value'=>$_SESSION['userStore']->lastname ?? '',
					'required'=>true
				],
				'email'=>[ 
					'type'=>'email',
					'label'=>'Email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'Ex : john.doe@gmail.com',
					'value'=>$_SESSION['userStore']->email ?? '',
					'error'=>'Votre email doit faire entre 8 et 320 caractères',
					'required'=>true
				],
				'pwd'=>[
					'type'=>'password',
					'label'=>'Mot de passe',
					'minLength'=>8,
					'id'=>'pwd',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Votre mot de passe doit faire au minimum 8 caractères',
					'required'=>false
				],
				// 'pwdConfirm'=>[ 
				// 	'type'=>'password',
				// 	'label'=>'Confirmation',
				// 	'confirm'=>'pwd',
				// 	'id'=>'pwdConfirm',
				// 	'class'=>'form_input',
				// 	'placeholder'=>'',
				// 	'error'=>'Votre mot de mot de passe de confirmation ne correspond pas',
				// ],
				'image'=>[
					'type'=>'file',
					'label'=>'Avatar',
					'id'=>'upfile',
					'name'=>'upfile',
					'class'=>'form_input',
					'error'=>'Image invalide',
					'required'=>false
				]
			]
		];
	}

	public function formCreateUser() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_register',
				'class'=>'form',
				'submit'=>'Enregistrer',
				'enctype'=>'multipart/form-data'
			],
			'inputs'=>[
				'firstname'=>[
					'type'=>'text',
					'label'=>'Prénom',
					'minLength'=>2,
					'maxLength'=>55,
					'id'=>'firstname',
					'class'=>'form_input',
					'placeholder'=>'John',
					'error'=>'Le prénom doit faire entre 2 et 55 caractères.',
					'required'=>true
				],
				'lastname'=>[ 
					'type'=>'text',
					'label'=>'Nom',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'lastname',
					'class'=>'form_input',
					'placeholder'=>'Doe',
					'error'=>'Le nom doit faire entre 2 et 255 caractères.',
					'required'=>true
				],
				'email'=>[ 
					'type'=>'email',
					'label'=>'Email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'john.doe@gmail.com',
					'error'=>'L\'email doit faire entre 8 et 320 caractères.',
					'required'=>true
				],
				'pwd'=>[ 
					'type'=>'password',
					'label'=>'Mot de passe',
					'minLength'=>8,
					'id'=>'pwd',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Le mot de passe doit faire au minimum 8 caractères.',
					'required'=>true
				],
				'pwdConfirm'=>[
					'type'=>'password',
					'label'=>'Confirmation',
					'confirm'=>'pwd',
					'id'=>'pwdConfirm',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Les mot de passe ne correspondent pas.',
					'required'=>true
				],
				'role'=>[
					'type'=>'select',
					'label'=>'Role',
					'id'=>'role',
					'class'=>'form_input',
					'options'=>['Utilisateur', 'Administrateur'],
					'required'=>true
				],
				'image'=>[
					'type'=>'file',
					'label'=>'Avatar',
					'id'=>'upfile',
					'name'=>'upfile',
					'class'=>'form_input',
					'error'=>'Image invalide',
					'required'=>false
				]
			]
		];
	}

	public function formEditUser() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_register',
				'class'=>'form',
				'submit'=>'Enregistrer',
				'enctype'=>'multipart/form-data'
			],
			'inputs'=>[
				'firstname'=>[
					'type'=>'text',
					'label'=>'Prénom',
					'minLength'=>2,
					'maxLength'=>55,
					'id'=>'firstname',
					'class'=>'form_input',
					'placeholder'=>'John',
					'error'=>'Le prénom doit faire entre 2 et 55 caractères.',
					'required'=>true,
					'value'=>$this->getFirstname()
				],
				'lastname'=>[ 
					'type'=>'text',
					'label'=>'Nom',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'lastname',
					'class'=>'form_input',
					'placeholder'=>'Doe',
					'error'=>'Le nom doit faire entre 2 et 255 caractères.',
					'required'=>true,
					'value'=>$this->getLastname()
				],
				'email'=>[ 
					'type'=>'email',
					'label'=>'Email',
					'minLength'=>8,
					'maxLength'=>320,
					'id'=>'email',
					'class'=>'form_input',
					'placeholder'=>'john.doe@gmail.com',
					'error'=>'L\'email doit faire entre 8 et 320 caractères.',
					'required'=>true,
					'value'=>$this->getEmail()
				],
				'role'=>[
					'type'=>'select',
					'label'=>'Role',
					'id'=>'role',
					'class'=>'form_input',
					'options'=>['Utilisateur', 'Administrateur'],
					'required'=>true,
					'value'=>$this->getRole() === 'user' ? 0 : 1
				],
				'avatar'=>[
					'type'=>'file',
					'label'=>'Avatar',
					'id'=>'upfile',
					'name'=>'upfile',
					'class'=>'form_input',
					'error'=>'Image invalide',
					'required'=>false
				]
			]
		];
	}
}