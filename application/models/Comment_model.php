<?php

class Comment_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function add_comment($post_id)
  {
    $data = [
      'post_id' => $post_id,
      'name' => $this->input->post('name'),
      'email' => $this->input->post('email'),
      'body' => $this->input->post('body')
    ];

    return $this->db->insert('comments', $data);
  }

  public function get_comments($post_id)
  {
    $this->db->order_by('created_at', 'ASC');
    $query = $this->db->get_where('comments', ['post_id' => $post_id]);
    return $query->result_array();
  }
}
