<?php

namespace App\Models;

use App\Core\Database;

class Settings extends Database {
	private $id = null;
	protected $appName;
	protected $visibility = 1;
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
	public function getAppName() {
		return $this->appName;
	}

	/**
	 * @param mixed $appname
	 */
	public function setAppName($appName) {
		$this->appName = $appName;
	}

	/**
	 * @return int
	 */
	public function getVisibility(): int {
		return $this->visibility;
	}

	/**
	 * @param int $visibility
	 */
	public function setVisibility(int $visibility) {
		$this->visibility = $visibility;
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

	public function formSettings() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_settings',
				'class'=>'form',
				'submit'=>'Enregistrer',
				'enctype'=>'multipart/form-data'
			],
			'inputs'=>[
				'appName'=>[
					'type'=>'text',
					'label'=>'Nom du site',
					'minLength'=>2,
					'maxLength'=>15,
					'id'=>'appName',
					'class'=>'form_input',
					'placeholder'=>$this->getAppName(),
					'error'=>'Le nom du site doit faire entre 2 et 15 caractères.',
					'required'=>true,
					'value'=>$this->getAppName()
				],
				'visibility'=>[
					'type'=>'checkbox',
					'label'=>'Visibilité du site sur les moteurs de recherche',
					'id'=>'lastname',
					'class'=>'form_input',
					'value'=> $this->getVisibility() == 1 ? 'on' : 'off'
				]
			]
		];
	}
}