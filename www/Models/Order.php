<?php

namespace App\Models;

use App\Core\Database;

class Order extends Database {
	private $id = null;
	protected $status = 0;
	protected $total_price = 0;
	protected $product_count = 0;
	protected $user_id = null;
	protected $address_id = null;
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
	}

	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return mixed
	 */
	public function getTotal_price() {
		return $this->total_price;
	}

	/**
	 * @param mixed $total_price
	 */
	public function setTotal_price($total_price) {
		$this->total_price = $total_price;
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
     * @return null
     */
    public function getAddress_id()
    {
        return $this->address_id;
    }

    /**
     * @param null $address_id
     */
    public function setAddress_id($address_id): void
    {
        $this->address_id = $address_id;
    }
}