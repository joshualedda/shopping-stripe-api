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
	public function check_login($email_or_contact, $password)
	{
		$sql = "SELECT * FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email_or_contact));

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
	public function registerUser($first_name, $last_name, $email, $hashed_password)
	{
		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
		$query = $this->db->query($sql, array($first_name, $last_name, $email, $hashed_password));

		return $query ? true : false;
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
