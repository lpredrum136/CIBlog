<?php

class User_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  // REGISTER
  public function register($enc_password)
  {
    $data = [
      'name' => $this->input->post('name'),
      'zipcode' => $this->input->post('zipcode'),
      'email' => $this->input->post('email'),
      'username' => $this->input->post('username'),
      'password' => $enc_password
    ];

    return $this->db->insert('users', $data);
  }

  // Check username exists
  public function check_username_exists($username)
  {
    $query = $this->db->get_where('users', ['username' => $username]);
    if (empty($query->row_array())) return true;
    else return false;
  }

  // Check email exists
  public function check_email_exists($email)
  {
    $query = $this->db->get_where('users', ['email' => $email]);
    if (empty($query->row_array())) return true;
    else return false;
  }

  // LOGIN
  public function login($enc_password)
  {
    // Cach 1
    /* $condition = [
      'username' => $this->input->post('username'),
      'password' => $enc_password
    ];

    $query = $this->db->get_where('users', $condition);
    return $query->result_array(); */

    // Cach 2 
    # Validate
    $this->db->where('username', $this->input->post('username'));
    $this->db->where('password', $enc_password);

    $result = $this->db->get('users');

    if ($result->num_rows() == 1) return $result->row_array()['id'];
    else return false;
  }
}
