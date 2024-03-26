<?php

class User extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	//if email exist
	public function is_email_exists($email)
	{
		$sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));

		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->count > 0;
		}

		return false;
	}

	//handle login
	public function loginUser($email, $password)
	{

		$this->form_validation->set_rules('email', 'Contact Number/Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			return null; 
		}

		$email = $this->security->xss_clean($email);
		$password = $this->security->xss_clean($password);

		$sql = "SELECT * FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));

		if ($query->num_rows() == 1) {
			$user = $query->row_array();
			$hashed_password = $user['password'];

			if (password_verify($password, $hashed_password)) {
				return $user;
			}
		}

		return null; 
	}

	//register

	public function registerUser($first_name, $last_name, $email, $password)
	{

		$this->form_validation->set_data(array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'password' => $password,
			'password_confirmation' => $password
		));

		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == false) {
			return false;
		}

		$clean_data = array(
			'first_name' => xss_clean($first_name),
			'last_name' => xss_clean($last_name),
			'email' => xss_clean($email),
			'password' => password_hash($password, PASSWORD_DEFAULT)
		);

		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
		$insert_result = $this->db->query($sql, $clean_data);

		return $insert_result ? true : false;
	}


	//dashboard
	public function getUserById($user_id)
	{
		$sql = "SELECT * FROM users WHERE id = ?";

		$query = $this->db->query($sql, array($user_id));

		if ($query->num_rows() == 1) {
			return $query->row_array();
		}

		return null;
	}
}
