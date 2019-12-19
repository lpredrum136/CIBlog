<?php
class Post_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_posts($slug = FALSE)
  {
    if ($slug === FALSE) {
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get('posts');
      return $query->result_array();
    }

    $query = $this->db->get_where('posts', ['slug' => $slug]);
    return $query->row_array();
  }

  public function get_post_by_id($post_id)
  {
    $query = $this->db->get_where('posts', ['id' => $post_id]);
    return $query->row_array();
  }

  public function create_post()
  {
    $slug = url_title($this->input->post('title')); // This is how to get form data

    // Data to send to db
    $data = [
      'title' => $this->input->post('title'),
      'slug' => $slug,
      'body' => $this->input->post('body')
    ];

    return $this->db->insert('posts', $data);
  }

  public function delete_post($delete_id)
  {
    $this->db->where('id', $delete_id);
    $this->db->delete('posts');
    return true;
  }

  public function update_post()
  {
    // Data to send for update
    $data = [
      'title' => $this->input->post('title'),
      'slug' => url_title($this->input->post('title')),
      'body' => $this->input->post('body')
    ];

    $this->db->where('id', $this->input->post('update_id'));
    return $this->db->update('posts', $data);
  }
}
