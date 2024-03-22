<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User');
        $this->load->model('Product');
    }

    private function prepareUserData()
    {
        $user_id = $this->session->userdata('id');
        $user_data = $this->User->getUserById($user_id);
        $is_logged_in = $this->session->userdata('logged_in');

        return array('user_data' => $user_data, 'is_logged_in' => $is_logged_in);
    }

    public function index()
    {
        $data = $this->prepareUserData();
        $data['products'] = $this->Product->fetchProducts();
		
		$data['cart_count'] = $this->getCartCount($this->session->userdata('id'));
		
        $this->load->view('partials/header', $data);
        $this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');

        $this->load->view('products/index', $data);
        $this->load->view('partials/footer');
    }

	private function getCartCount($user_id)
    {
        return $this->Cart->countCart($user_id);
    }

    public function details($product_id)
    {
	
        $data = $this->prepareUserData();
        $data['product'] = $this->Product->getProductDetails($product_id);

        if ($data['product']) {
            $data['title'] = $data['product']['name'];
        } else {
            $data['title'] = 'Product Not Found';
        }
		$data['cart_count'] = $this->getCartCount($this->session->userdata('id'));

        $this->load->view('partials/header', $data);
		
        $this->load->view('partials/navbar', $data);
		$this->load->view('partials/alert');
        $this->load->view('products/details', $data);
        $this->load->view('partials/footer');
    }
}
