<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{
	
    public function index()
    {

		$data['title'] = "Dashboard";
	
        $this->load->view('partials/header', $data);
        $this->load->view('partials/alert');
        $this->load->view('dashboard/dashboard');
        $this->load->view('partials/footer');
    }
}
