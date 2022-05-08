<?php
class Inbox_model extends CI_Model
{
  public function get_Inbox($id = null) {
    if ($id === null) {
      return $this->db->get('inbox')->result_array();
    } else {
      return $this->db->get_where('inbox', ['id' => $id])->result_array();
    }
  }
  
  // Create Data
  public function create_Inbox($data) {
    $this->db->insert('inbox', $data);
    return $this->db->affected_rows();
  }
  
  // Update Data
  public function update_Inbox($data, $id) {
    $this->db->where('id', $id);
    $this->db->update('inbox', $data);
    return $this->db->affected_rows();
  }
  
  // Delete Data
  public function delete_Inbox($id) {
    $this->db->delete('inbox', ['id' => $id]);
    return $this->db->affected_rows();
  }
}