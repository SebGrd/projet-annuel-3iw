<?php

namespace App\Models;

use App\Core\Database;

class Product_Order extends Database {
	private $id = null;
	protected $order_id = null;
	protected $product_id = null;

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
	}

	/**
	 * @return mixed
	 */
	public function getOrder_id() {
		return $this->order_id;
	}

	/**
	 * @param null $order_id
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
	 * @param null $product_id
	 */
	public function setProduct_id($product_id) {
		$this->product_id = $product_id;
	}
}
