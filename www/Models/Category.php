<?php

namespace App\Models;

use App\Core\Database;

class Category extends Database {
	private $id = null;
	protected $name;
	protected $description;

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
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	public function formCategory() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_category',
				'class'=>'form',
				'submit'=>"Enregistrer"
			],
			'inputs'=>[
				'name'=>[ 
					'type'=>'text',
					'label'=>'Nom de la catégorie',
					'minLength'=>2,
					'maxLength'=>50,
					'id'=>'title',
					'class'=>'form_input',
					'error'=>'Le nom du menu doit faire entre 2 et 50 caractères',
					'required'=>true
				],
				'description'=>[ 
					'type'=>'text',
					'label'=>'Description de la catégorie',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'description',
					'class'=>'form_input',
					'error'=>'La description du menu doit faire entre 2 et 255 caractères',
					'required'=>false
				]
			]
		];
	}
}