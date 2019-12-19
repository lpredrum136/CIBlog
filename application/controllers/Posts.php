<?php

class Posts extends CI_Controller
{
  public function index()
  {
    $data['title'] = 'Latest Posts';

    $data['posts'] = $this->post_model->get_posts();

    $this->load->view('templates/header');
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer');
  }

  public function view($slug = NULL)
  {
    $data['post'] = $this->post_model->get_posts($slug);

    if (empty($data['post'])) show_404();

    // $data['title'] = $data['post']['title'];

    $this->load->view('templates/header');
    $this->load->view('posts/view', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    $data['title'] = 'Create Post';

    // Create rules for validation form when it is submitted
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    // Check if form is submitted. If not, render the view
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
      $this->load->view('posts/create', $data);
      $this->load->view('templates/footer');
    } else {
      $this->post_model->create_post();
      redirect('posts');
    }
  }

  public function delete($delete_id)
  {
    // echo $delete_id;
    $this->post_model->delete_post($delete_id);
    redirect('posts');
  }

  public function edit($edit_id)
  {
    $data['post'] = $this->post_model->get_post_by_id($edit_id);

    // Check if form is submitted. If not, render the view
    $this->load->view('templates/header');
    $this->load->view('posts/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update()
  {
    $this->post_model->update_post();
    redirect('posts');
  }
}
