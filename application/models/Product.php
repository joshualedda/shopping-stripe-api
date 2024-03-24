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
	
	/*Product Price*/ 
	public function getProductPrice($product_ids) {
		$sql = "SELECT price FROM products WHERE id = ?";
		$query = $this->db->query($sql, array($product_ids));
	
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return (float) $row->price; 
		} else {
			return null;
		}
	}
	//test2
	public function getProductById($product_id)
    {
        $query = $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id));

        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        } else {
            return null;
        }
    }
}
