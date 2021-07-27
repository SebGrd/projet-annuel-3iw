<?php

namespace App\Models;

use App\Core\Database;

class Product_Order extends Database {
	private $id = null;
	protected $order_id = null;
	protected $product_id = null;
	protected $product_quantity = null;

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
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getOrder_id() {
		return $this->order_id;
	}

	/**
	 * @param int $order_id
	 */
	public function setOrder_id($order_id) {
		$this->order_id = $order_id;
	}

	/**
	 * @return mixed
	 */
	public function getProduct_id() {
		return $this->product_id;
	}

	/**
	 * @param int $product_id
	 */
	public function setProduct_id($product_id) {
		$this->product_id = $product_id;
	}

	/**
	 * @return mixed
	 */
	public function getProduct_quantity() {
		return $this->product_quantity;
	}

	/**
	 * @param int $product_quantity
	 */
	public function setProduct_quantity($product_quantity) {
		$this->product_quantity = $product_quantity;
	}
}
