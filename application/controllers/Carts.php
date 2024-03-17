<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('stripe_lib');
	}

	public function index()
	{
		$user_id = $this->session->userdata('id');
		$data['carts'] = $this->Cart->userCart($user_id);
		$data['cart_count'] = $this->Cart->countCart($user_id);
		$data += $this->prepareUserData();

		$this->load->view('partials/header');
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');
		$this->load->view('products/cart', $data);
		$this->load->view('partials/footer');
	}



	private function prepareUserData()
	{
		$user_id = $this->session->userdata('id');
		$user_data = $this->User->getUserById($user_id);
		$is_logged_in = $this->session->userdata('logged_in');

		return array('user_data' => $user_data, 'is_logged_in' => $is_logged_in);
	}

	public function addToCart()
	{
    if (!$this->session->userdata('logged_in')) {
        $this->session->set_flashdata('error', 'Please login first to add products to your cart.');
        redirect('login');
    }

    $this->form_validation->set_rules('user_id', 'User ID', 'required');
    $this->form_validation->set_rules('product_id', 'Product ID', 'required');
    $this->form_validation->set_rules('quantity', 'Quantity', 'required');

    if ($this->form_validation->run() == false) {
        $this->load->view('partials/header');
        $this->load->view('partials/navbar');
		$this->load->view('partials/alert');
        $this->load->view('products/cart');
        $this->load->view('partials/footer');
    } else {
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');

        $result = $this->Cart->addToCart($user_id, $product_id, $quantity);

        if ($result) {
            $this->session->set_flashdata('success', 'Product added to cart successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add product to cart.');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}


	public function removeCartItem($product_id)
	{

		$user_id = $this->session->userdata('id');
	
		$result = $this->Cart->removeItemFromCart($user_id, $product_id);
	
		if ($result) {
			$this->session->set_flashdata('success', 'Product removed from cart successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to remove product from cart.');
		}
	
		redirect('carts');
	}
	


	public function checkOut($product_id)
	{
		$user_id = $this->session->userdata('id');
		$data['carts'] = $this->Cart->userCart($user_id);
		$data['cart_count'] = $this->Cart->countCart($user_id);
		$data += $this->prepareUserData();
		//product details
		$data['product'] = $this->Product->getProductDetails($product_id);

		$this->load->view('partials/header');
		$this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');
		$this->load->view('products/checkout', $data);
		$this->load->view('partials/footer');
	}

	
}
