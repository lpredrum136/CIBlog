<?php

class Categories extends CI_Controller
{
  public function index()
  {
    $data['title'] = 'Categories';
    $data['categories'] = $this->category_model->get_categories();

    $this->load->view('templates/header');
    $this->load->view('categories/index', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    // Check if user logged in
    if (!$this->session->has_userdata('logged_in')) redirect('users/login');

    $data['title'] = 'Create Category';

    // Create rules for validation form when it is submitted
    $this->form_validation->set_rules('name', 'Name', 'required');
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
      $this->load->view('categories/create', $data);
      $this->load->view('templates/footer');
    } else {
      $this->category_model->create_category();

      // Set message
      $this->session->set_flashdata('category_created', 'Your category has been created');

      redirect('categories');
    }
  }

  public function posts($id = NULL)
  {
    $data['category_posts'] = $this->category_model->get_categories($id);
    if (empty($data['category_posts'])) show_404();

    $this->load->view('templates/header');
    $this->load->view('categories/posts', $data);
    $this->load->view('templates/footer');
  }
}
