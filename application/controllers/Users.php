<?php

class Users extends CI_Controller
{
  // REGISTER
  public function register()
  {
    $data['title'] = 'Sign Up';

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
    $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
      $this->load->view('users/register', $data);
      $this->load->view('templates/footer');
    } else {
      // Encrypt password
      $enc_password = md5($this->input->post('password'));

      $this->user_model->register($enc_password);

      // Set message
      $this->session->set_flashdata('user_registered', 'You are now registered and can login');

      redirect('posts');
    }
  }

  // Check if username already exists
  public function check_username_exists($username)
  {
    // Set the message
    $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose another.');

    // Do the real check
    if ($this->user_model->check_username_exists($username)) return true;
    else return false;
  }

  // Check if email already exists
  public function check_email_exists($email)
  {
    // Set the message
    $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose another.');

    // Do the real check
    if ($this->user_model->check_email_exists($email)) return true;
    else return false;
  }

  // LOGIN
  public function login()
  {
    $data['title'] = 'Login';

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
      $this->load->view('users/login', $data);
      $this->load->view('templates/footer');
    } else {
      // Encrypt password
      $enc_password = md5($this->input->post('password'));

      $user_id = $this->user_model->login($enc_password);

      if ($user_id) {
        // Create session
        # die($user_id);
        $user_data = [
          'user_id' => $user_id,
          'username' => $this->input->post('username'),
          'logged_in' => true
        ];

        $this->session->set_userdata($user_data);

        // Set message
        $this->session->set_flashdata('user_successful_logged_in', 'Login successful');

        redirect('posts');
      } else {
        // Set message
        $this->session->set_flashdata('user_unsuccessful_logged_in', 'Please check your credentials');

        redirect('users/login');
      }
    }
  }

  // LOGOUT
  public function logout()
  {
    // Unset user data
    $this->session->unset_userdata(['user_id', 'username', 'logged_in']);

    // Set message
    $this->session->set_flashdata('user_logged_out', 'You are now logged out');

    redirect('users/login');
  }
}
