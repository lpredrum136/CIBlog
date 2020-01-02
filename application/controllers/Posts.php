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

    // Get comments for this post
    $post_id = $data['post']['id'];
    $data['comments'] = $this->comment_model->get_comments($post_id);

    $this->load->view('templates/header');
    $this->load->view('posts/view', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    $data['title'] = 'Create Post';

    $data['categories'] = $this->post_model->get_categories();

    // Create rules for validation form when it is submitted
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('body', 'Body', 'required');

    // Check if form is submitted. If not, render the view
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header');
      $this->load->view('posts/create', $data);
      $this->load->view('templates/footer');
    } else {
      // Upload Image
      $config['upload_path'] = './assets/images/posts';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '2048';
      $config['max_width'] = '500';
      $config['max_height'] = '500';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload()) { // If not uploaded
        $errors = ['error' => $this->upload->display_errors()];
        $post_image = 'noimage.jpg';
      } else {
        $data = ['upload_data' => $this->upload->data()];
        $post_image = $_FILES['userfile']['name']; // postimage is the name of the HTML field to input image
      }

      $this->post_model->create_post($post_image);

      // Set message
      $this->session->set_flashdata('post_created', 'Your post has been created');

      redirect('posts');
    }
  }

  public function delete($delete_id)
  {
    // echo $delete_id;
    $this->post_model->delete_post($delete_id);

    // Set message
    $this->session->set_flashdata('post_deleted', 'Your post has been deleted');

    redirect('posts');
  }

  public function edit($edit_id)
  {
    $data['post'] = $this->post_model->get_post_by_id($edit_id);
    $data['categories'] = $this->post_model->get_categories();

    // Check if form is submitted. If not, render the view
    $this->load->view('templates/header');
    $this->load->view('posts/edit', $data);
    $this->load->view('templates/footer');
  }

  public function update()
  {
    $this->post_model->update_post();

    // Set message
    $this->session->set_flashdata('post_updated', 'Your post has been updated');

    redirect('posts');
  }
}
