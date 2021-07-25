<?php

namespace App\Models;

use App\Core\Database;

class Address extends Database {
	private $id = null;
	protected $user_id = '';
	protected $name = '';
	protected $address = '';
	protected $address2 = '';
	protected $district = '';
	protected $city = '';
	protected $postal_code = '';
	protected $phone = 0;
	protected $updatedAt = '';

	public function __construct(){
		parent::__construct();
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
	}

	/**
	 * @return mixed
	 */
	public function getUser_id() {
		return $this->user_id;
	}

	/**
	 * @param mixed $user_id
	 */
	public function setUser_id($user_id) {
		$this->user_id = $user_id;
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
	public function getProduct_count() {
		return $this->product_count;
	}

	/**
	 * @param mixed $product_count
	 */
	public function setProduct_count($product_count) {
		$this->product_count = $product_count;
	}

	/**
	 * @return mixed
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param mixed $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @return mixed
	 */
	public function getAddress2() {
		return $this->address;
	}

	/**
	 * @param mixed $address2
	 */
	public function setAddress2($address2) {
		$this->address2 = $address2;
	}

	/**
	 * @return mixed
	 */
	public function getDistrict() {
		return $this->district;
	}

	/**
	 * @param mixed $district
	 */
	public function setDistrict($district) {
		$this->district = $district;
	}

	/**
	 * @return mixed
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param mixed $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @return mixed
	 */
	public function getPostal_code() {
		return $this->postal_code;
	}

	/**
	 * @param mixed $postal_code
	 */
	public function setPostal_code($postal_code) {
		$this->postal_code = $postal_code;
	}

	/**
	 * @return int
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param int $phone
	 */
	public function setphone($phone) {
		$this->phone = $phone;
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
}