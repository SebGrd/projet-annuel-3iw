<?php

namespace App\Models;

use App\Core\Database;

class Image extends Database {
	private $id = null;
	protected $file_name = '';
	protected $user_id = null;
	protected $createdAt = '';

	public function __construct(){
		parent::__construct();
		if ($this->id == null) {
			$this->setCreatedAt();
		}
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
	public function getFile_name() {
		return $this->file_name;
	}

	/**
	 * @param mixed $file_name
	 */
	public function setFile_name($file_name) {
		$this->file_name = $file_name;
	}

	/**
	 * @return string
	 */
	public function getUser_id(): string {
		return $this->user_id;
	}

	/**
	 * @param string $user_id
	 */
	public function setUser_id($user_id) {
		$this->user_id = $user_id;
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

}
