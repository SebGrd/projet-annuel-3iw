<?php

namespace App\Models;

use App\Core\Database;

class Menu extends Database {
	private $id = null;
	protected $title = '';
	protected $description = '';
	protected $image = '';
	protected $active = 1;
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
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title) {
		$this->title = $title;
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

	/**
	 * @return mixed
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @param mixed $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * @return mixed
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @param mixed $active
	 */
	public function setActive($active) {
		$this->active = $active;
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

	public function formMenu() {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_menu',
				'class'=>'form',
				'submit'=>'Enregistrer',
				'enctype'=>'multipart/form-data'
			],
			'inputs'=>[
				'title'=>[ 
					'type'=>'text',
					'label'=>'Nom du menu',
					'minLength'=>2,
					'maxLength'=>50,
					'id'=>'title',
					'class'=>'form_input',
					'error'=>'Le nom du menu doit faire entre 2 et 50 caractères',
					'required'=>true,
					'value'=>$this->title
				],
				'description'=>[ 
					'type'=>'text',
					'label'=>'Description du menu',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'description',
					'class'=>'form_input',
					'error'=>'La description du menu doit faire entre 2 et 255 caractères',
					'required'=>false,
					'value'=>$this->description
				],
				'image'=>[
					'type'=>'file',
					'label'=>'Image du menu',
					'id'=>'upfile',
					'name'=>'upfile',
					'class'=>'form_input',
					'placeholder'=>'',
					'error'=>'Image invalide',
					'required'=>false,
					'value'=>$this->image
				]
			]
		];
	}
}