<?php

class Product extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	//select product
	public function fetchProducts()
	{
		$sql = 'SELECT * FROM products';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	//fetch singel product
	public function getProductDetails($product_id)
	{
		$sql = "SELECT * FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($product_id));

		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return null;
		}
	}
}
