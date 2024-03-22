<?php

class Cart extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	//cart
	public function addToCart($user_id, $product_id, $quantity)
	{
		$sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)";
		$this->db->query($sql, array($user_id, $product_id, $quantity));

		return ($this->db->affected_rows() > 0);
	}
	//viewcart
	public function userCart($user_id)
	{
		$sql = "SELECT carts.product_id, products.name, SUM(carts.quantity) AS total_quantity, products.price 
				FROM carts
				JOIN products ON products.id = carts.product_id
				WHERE carts.user_id = ?
				GROUP BY carts.product_id";

		$query = $this->db->query($sql, array($user_id));

		return $query->result_array();
	}


	//count cart
	public function countCart($user_id)
	{
		$sql = "SELECT COUNT(DISTINCT product_id) as total_items FROM carts WHERE user_id = ?";
		$query = $this->db->query($sql, array($user_id));

		if ($query->num_rows() == 1) {
			$result = $query->row_array();
			return $result['total_items'];
		} else {
			return 0;
		}
	}
	//remove cart
	public function removeItemFromCart($user_id, $product_id)
	{
		$sql = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
		$params = array($user_id, $product_id);

		$query = $this->db->query($sql, $params);

		return $this->db->affected_rows() > 0;
	}

	//count query
	public function getCartsByUserId($user_id)
    {
        $sql = "SELECT * FROM carts WHERE user_id = ?";
        $query = $this->db->query($sql, array($user_id));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array(); 
        }
    }

	//add orders
	public function saveOrder($user_id, $product_id, $quantity)
    {

        $sql = "INSERT INTO orders (user_id, product_id) VALUES (?, ?, ?)";
        $this->db->query($sql, array($user_id, $product_id, $quantity));
    }
}
