<?php

require __DIR__ . '/../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class Posts extends CI_Controller
{
  public function index($offset = 0)
  {
    // Pagination: Limit number of posts per page
    $config['base_url'] = base_url() . 'posts/index/';
    $config['total_rows'] = $this->db->count_all('posts');
    $config['per_page'] = 3;
    $config['uri_segment'] = 3; # /post/index/4 for example, so number 4 is the "3"rd param, that's why we use 3
    $config['attributes'] = ['class' => 'pagination-link']; # make it look nicer

    // Init pagination
    $this->pagination->initialize($config);

    $data['title'] = 'Latest Posts';

    $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

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
    // Check if user logged in
    if (!$this->session->has_userdata('logged_in')) redirect('users/login');

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

      $post_image = null;
      if (!$this->upload->do_upload()) { // If not uploaded
        $errors = ['error' => $this->upload->display_errors()];
        $post_image = 'noimage.jpg';
      } else {
        $data = ['upload_data' => $this->upload->data()];
        $post_image = $_FILES['userfile']['name']; // postimage is the name of the HTML field to input image
      }

      // Add this image to AWS S3 Bucket
      $this->load->config('aws');
      $s3 = new S3Client([
        'version' => 'latest',
        'region' => 'us-east-2',
        'credentials' => [
          'key' => config_item('S3_key'),
          'secret' => config_item('S3_secret')
        ]
      ]);

      // Now we send it to S3 Bucket
      $result = $s3->putObject([
        'Bucket' => 'henry-bucket',
        'Key' => $post_image,
        'SourceFile' => $_FILES['userfile']['tmp_name']
      ]);

      // Add into local database
      $this->post_model->create_post($post_image);

      // Set message
      $this->session->set_flashdata('post_created', 'Your post has been created');

      redirect('posts');
    }
  }

  public function delete($delete_id)
  {
    // Check if user logged in
    if (!$this->session->has_userdata('logged_in')) redirect('users/login');

    # echo $delete_id;
    $this->post_model->delete_post($delete_id);

    // Set message
    $this->session->set_flashdata('post_deleted', 'Your post has been deleted');

    redirect('posts');
  }

  public function edit($edit_id)
  {
    // Check if user logged in
    if (!$this->session->has_userdata('logged_in')) redirect('users/login');

    $data['post'] = $this->post_model->get_post_by_id($edit_id);

    if (empty($data['post'])) show_404();
    else if ($this->session->userdata('user_id') != $data['post']['user_id']) redirect('posts'); // Check if user authenticated to edit
    else {
      $data['categories'] = $this->post_model->get_categories();

      // Check if form is submitted. If not, render the view
      $this->load->view('templates/header');
      $this->load->view('posts/edit', $data);
      $this->load->view('templates/footer');
    }
  }

  public function update()
  {
    // Check if user logged in
    if (!$this->session->has_userdata('logged_in')) redirect('users/login');

    $this->post_model->update_post();

    // Set message
    $this->session->set_flashdata('post_updated', 'Your post has been updated');

    redirect('posts');
  }
}
