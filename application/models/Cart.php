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
		$user_id = $this->security->xss_clean($user_id);
		$product_id = $this->security->xss_clean($product_id);
		$quantity = $this->security->xss_clean($quantity);

		$sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)";
		
		$this->db->query($sql, array($user_id, $product_id, $quantity));

		return ($this->db->affected_rows() > 0);
	}

	//add to cart validation
	public function validateAddToCart()
	{
		$this->form_validation->set_rules('user_id', 'User ID', 'required');
		$this->form_validation->set_rules('product_id', 'Product ID', 'required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required');

		return $this->form_validation->run();
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

		$this->db->query($sql, $params);

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

	//delete order after purchase
	public function deleteCartItem($user_id, $product_id)
	{
		$user_id = $this->security->xss_clean($user_id);
		$product_id = $this->security->xss_clean($product_id);

		$sql = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
		$this->db->query($sql, array($user_id, $product_id));
		return $this->db->affected_rows() > 0;
	}

		//add orders
	public function saveOrder($user_id, $product_id, $quantity)
	{
		$user_id = $this->security->xss_clean($user_id);
		$product_id = $this->security->xss_clean($product_id);
		$quantity = $this->security->xss_clean($quantity);
		
		$sql = "INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)";
		$this->db->query($sql, array($user_id, $product_id, $quantity));
	}

		
	//validate stripe
	public function validateStripe()
	{	
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('card_number', 'Card Number', 'required');

		return $this->form_validation->run();
	}



}
