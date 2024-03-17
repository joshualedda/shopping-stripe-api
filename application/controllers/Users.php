<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('User');
        $this->load->database();
    }

    public function index()
    {
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		}

		$data['title'] = "Login";
	
        $this->load->view('partials/header', $data);
        $this->load->view('partials/alert');
        $this->load->view('auth/login');
        $this->load->view('partials/footer');
    }

    public function register()
    {
		$data['title'] = "Register";
        $this->load->view('partials/header', $data);
        $this->load->view('partials/alert');
        $this->load->view('auth/register');
        $this->load->view('partials/footer');
    }

    public function registerProcess()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('partials/header');
            $this->load->view('auth/register');
            $this->load->view('partials/footer');
        } else {
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->security->xss_clean($this->input->post('password'));

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $result = $this->User->registerUser($first_name, $last_name, $email, $hashed_password);

            if ($result) {
                $this->session->set_flashdata('success', 'Registered Successfully.');
                redirect('users/register');
            } else {
                $this->session->set_flashdata('error', 'Failed to register.');
                redirect('users/register');
            }
        }
    }

    public function check_email($email)
    {
        $this->load->model('User');
        if ($this->User->is_email_exists($email)) {
            $this->form_validation->set_message('check_email', 'The email already exists.');
            return false;
        }
        return true;
    }

    public function loginProcess()
    {
        $this->form_validation->set_rules('email', 'Contact Number/Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('partials/header');
            $this->load->view('auth/login');
            $this->load->view('partials/footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User->check_login($email, $password);

            if ($user) {
                $user_data = array(
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);                
                redirect('products');
            } else {
                $this->session->set_flashdata('error', 'Invalid credentials. Please try again.');
                redirect('login');
            }
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('success', 'Logged out successfully.');
        redirect('users');
    }
}
