<?php

class User extends CI_Model {
    
    public function __construct()
    {   
        $this->load->database();
    }


    public function is_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0; 
    }

    public function check_login($email_or_contact, $password) {
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
    
    public function registerUser($first_name, $last_name, $email, $hashed_password) {
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $query = $this->db->query($sql, array($first_name, $last_name, $email, $hashed_password));
    
        return $query ? true : false;
    }

    public function getUserById($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return null;
        }
    }
}
