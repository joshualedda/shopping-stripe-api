<?php

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Checkout\Session;

defined('BASEPATH') or exit ('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Carts extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('Cart');

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
			$this->index();
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
	public function checkOutStripe()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('card_number', 'Card Number', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
	
			if ($this->form_validation->run() == false) {
				$this->index();
			} else {
				$stripe_secret_key = "sk_test_51Ov8YdP4esyi7AIvH5E2wD8bsIzu8WLSr1NOcS1UBwnohK1m56IUvrKdYTK1kalagQ3z25piVhGJh5CoRHT1seZ600VgFTHnBE";
				\Stripe\Stripe::setApiKey($stripe_secret_key);
	
				$name = $this->input->post('name');
				$address = $this->input->post('address');
				$price = $this->input->post('price');
				$product_ids = $this->input->post('product_id');
				$products = $this->input->post('product');
				$quantities = $this->input->post('quantity');
	
				try {
					$customer = \Stripe\Customer::create([
						"name" => $name,
						"address" => [
							"line1" => $address,
						],
					]);
	
					$line_items = [];
					foreach ($product_ids as $index => $product_id) {
						$line_items[] = [
							"price_data" => [
								"currency" => "usd",
								"product_data" => [
									"name" => $products[$index],
								],
								"unit_amount" => $price * 100,
							],
							"quantity" => $quantities[$index],
						];
	
						$this->Cart->saveOrder($this->session->userdata('id'), $product_id, $quantities[$index]);
					}
	
					$checkout_session = \Stripe\Checkout\Session::create([
						"payment_method_types" => ["card"],
						"mode" => "payment",
						"line_items" => $line_items,
						"customer" => $customer->id,
						"success_url" => base_url('carts'),
					]);
	
					redirect($checkout_session->url, 'location');
				} catch (\Stripe\Exception\ApiErrorException $e) {
					echo "Error: " . $e->getMessage();
					$this->session->set_flashdata('error', 'Please try again.');
					redirect('carts');
				}
			}
		} else {
			redirect('carts');
		}
	}
	

	public function checkoutForm()
	{
		$this->load->view('checkout_form');
	}
}
