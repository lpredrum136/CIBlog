<?php

class Comments extends CI_Controller
{
  public function create($post_id)
  {
    // To redirect to this single post view when form validation fails
    $slug = $this->input->post('slug');
    $data['post'] = $this->post_model->get_posts($slug);

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('body', 'Body', 'required');

    if ($this->form_validation->run() === FALSE) {
      // Cannot do redirect here because that will make a new HTTP request to this route, like a refresh
      // Must re-render the view, now with form validation error, shown on the view
      $this->load->view('templates/header');
      $this->load->view('posts/view', $data);
      $this->load->view('templates/footer');
    } else {
      $this->comment_model->add_comment($post_id);
      redirect("posts/$slug");
    }
  }
}
