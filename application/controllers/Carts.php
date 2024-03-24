<?php

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Carts extends CI_Controller
{
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

	public function crsf()
	{
		if ($this->input->post($this->security->get_csrf_token_name()) !== $this->security->get_csrf_hash()) {
			$this->session->set_flashdata('error', 'The action you performed have been expired.');
		}
	}

	public function addToCart()
	{
		$this->crsf();

		if (!$this->Cart->validateAddToCart()) {

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
		$this->crsf();

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
		if (!$this->Cart->validateStripe()) {
			$this->index();
		} else {
			$stripe_secret_key = "sk_test_51Ov8YdP4esyi7AIvH5E2wD8bsIzu8WLSr1NOcS1UBwnohK1m56IUvrKdYTK1kalagQ3z25piVhGJh5CoRHT1seZ600VgFTHnBE";
			Stripe::setApiKey($stripe_secret_key);

			$name = $this->security->xss_clean($this->input->post('name'));
			$address = $this->security->xss_clean($this->input->post('address'));
			
			$product_ids = $this->input->post('product_id');
			$products = $this->input->post('product');
			$quantities = $this->input->post('quantity');
			$totalPrice = 0;

			foreach ($product_ids as $index => $product_id) {
				$product = $this->Product->getProductById($product_id); 
				if ($product) {
					$totalPrice += $product['price'];
				}
			}

			try {
				$customer = Customer::create([
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
							"unit_amount" => $totalPrice * 100,
						],
						"quantity" => $quantities[$index],
					];
					$this->Cart->saveOrder($this->session->userdata('id'), $product_id, $quantities[$index]);
					$this->session->set_flashdata('success', 'Thank you for purchasing!');
				}

				foreach ($product_ids as $product_id) {
					$this->Cart->deleteCartItem($this->session->userdata('id'), $product_id);
				}

				$checkout_session = Session::create([
					"payment_method_types" => ["card"],
					"mode" => "payment",
					"line_items" => $line_items,
					"customer" => $customer->id,
					"success_url" => base_url('carts'),
					"cancel_url" => base_url('carts'),
				]);

				redirect($checkout_session->url, 'location');

			} catch (ApiErrorException $e) {
				echo  $e->getMessage();
				$this->session->set_flashdata('error', 'Please add some item in your cart.');
				redirect('carts');
			}
		}
	}
}
