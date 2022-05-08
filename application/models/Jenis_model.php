<?php
class Jenis_model extends CI_Model
{
  public function get_jenis($jenis_id = null) {
    if ($jenis_id === null) {
      return $this->db->get('jenis')->result_array();
    } else {
      return $this->db->get_where('jenis', ['jenis_id' => $jenis_id])->result_array();
    }
  }
  
  // Create Data
  public function create_jenis($data) {
    $this->db->insert('jenis', $data);
    return $this->db->affected_rows();
  }
  
  // Update Data
  public function update_jenis($data, $jenis_id) {
    $this->db->where('jenis_id', $jenis_id);
    $this->db->update('jenis', $data);
    return $this->db->affected_rows();
  }
  
  // Delete Data
  public function delete_jenis($jenis_id) {
    $this->db->delete('jenis', ['jenis_id' => $jenis_id]);
    return $this->db->affected_rows();
  }
}