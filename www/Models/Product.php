<?php

namespace App\Models;

use App\Core\Database;

class Product extends Database {
	private $id = null;
	protected $name = '';
	protected $description = '';
	protected $quantity = 0;
	protected $price = 0;
	protected $rrp = 0;
	protected $image = 1;
	protected $menu_id = null;
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

	/**
	 * @return mixed
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @param mixed $quantity
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}

	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param mixed $image
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @return mixed
	 */
	public function getRrp() {
		return $this->rrp;
	}

	/**
	 * @param mixed $rrp (retail price, change this for sale on the product)
	 */
	public function setRrp($rrp) {
		$this->rrp = $rrp;
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
	public function getMenuId() {
		return $this->menu_id;
	}

	/**
	 * @param mixed $menu_id
	 */
	public function setMenuId($menu_id) {
		$this->menu_id = $menu_id;
	}

	/**
	 * @return mixed
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt() {
		$this->createdAt = date('Y-m-d H:i:s');
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * @param mixed $updatedAt
	 */
	public function setUpdatedAt() {
		$this->updatedAt = date('Y-m-d H:i:s');
	}

	public function formProduct($product = null) {
		return [
			'config'=>[
				'method'=>'POST',
				'action'=>'',
				'id'=>'form_product',
				'class'=>'form',
				'submit'=>"Enregistrer",
				'enctype'=>'multipart/form-data'
			],
			'inputs'=>[
				'name'=>[
					'type'=>'text',
					'label'=>'Nom du produit',
					'minLength'=>2,
					'maxLength'=>50,
					'id'=>'name',
					'class'=>'form_input',
					'error'=>'Le nom du produit doit faire entre 2 et 50 caractères',
					'required'=>true,
					'value'=>$this->name
				],
				'description'=>[
					'type'=>'text',
					'label'=>'Description du produit',
					'minLength'=>2,
					'maxLength'=>255,
					'id'=>'description',
					'class'=>'form_input',
					'error'=>'La description du produit doit faire entre 2 et 255 caractères',
					'required'=>false,
					'value'=>$this->description
				],
				'quantity'=>[
					'type'=>'numeric',
					'label'=>'Quantité disponible',
					'min'=>0,
					'max'=>100000,
					'id'=>'quantity',
					'class'=>'form_input',
					'error'=>'La quantité disponible du produit doit être un entier positif',
					'required'=>false,
					'value'=>$this->quantity
				],
				'price'=>[
					'type'=>'decimal',
					'label'=>'Prix du produit',
					'min'=>0,
					'max'=>100000.00,
					'id'=>'price',
					'class'=>'form_input',
					'error'=>'Le prix du produit doit être une décimale',
					'required'=>false,
					'value'=>$this->price
				],
				'image'=>[
					'type'=>'file',
					'label'=>'Image du produit',
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