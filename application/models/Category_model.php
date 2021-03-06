<?php

class Category_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_categories($id = NULL)
  {
    if ($id === NULL) {
      $this->db->order_by('name');
      $query = $this->db->get('categories');
      return $query->result_array();
    } else {
      $this->db->order_by('posts.id', 'DESC');
      $this->db->join('categories', 'posts.category_id = categories.id');
      $query = $this->db->get_where('posts', ['category_id' => $id]);
      return $query->result_array();
    }
  }

  public function create_category()
  {
    $data = [
      'name' => $this->input->post('name'),
      'user_id' => $this->session->userdata('user_id')
    ];
    return $this->db->insert('categories', $data);
  }

  public function delete_category($delete_id)
  {
    $this->db->where('id', $delete_id);
    $this->db->delete('categories');
    return true;
  }
}
