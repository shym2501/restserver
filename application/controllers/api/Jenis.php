<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Jenis extends RestController
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Jenis_model', 'jenis');
  }

  // Read jenis
  public function index_get()
  {
    $jenis_id = $this->get('jenis_id');
    if ($jenis_id === null) {
      $jenis = $this->jenis->get_jenis();
    } else {
      $jenis = $this->jenis->get_jenis($jenis_id);
    }
    if ($jenis) {
      $this->response([
        'status' => true,
        'data' => $jenis,
        'message' => 'All jenis is viewed'
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'jenis not found'
      ], 404);
    }
  }
  // #####

  // Create jenis
  public function index_post()
  {
    $data = [
      'jenis' => $this->input->post('jenis'),
      'warna' => $this->input->post('warna')
    ];
    if ($this->jenis->create_jenis($data) > 0) {
      $this->response([
        'status' => true,
        'message' => 'jenis has been created successfully.'
      ], 201);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Failed to create jenis '
      ], 403);
    }
  }
  // #####

  // Update jenis
  public function index_put()
  {
    $jenis_id = $this->put('id');
    $data = [
      'jenis' => $this->input->post('jenis'),
      'warna' => $this->input->post('warna')
    ];

    if ($this->jenis->update_jenis($data, $jenis_id) > 0) {
      $this->response([
        'status' => true,
        'message' => 'jenis has been updated successfully.'
      ], 204);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Failed to update jenis'
      ], 502);
    }
  }
  // #####

  // Delete jenis
  public function index_delete()
  {
    $jenis_id = $this->delete('jenis_id');
    if ($id === null) {
      $this->response([
        'status' => false,
        'message' => 'Provide an jenis'
      ], 502);
    } else {
      if ($this->jenis->delete_jenis($jenis_id) > 0) {
        $this->response([
          'status' => true,
          'message' => 'jenis has been deleted successfully.'
        ], 204);
      } else {
        $this->response([
          'status' => false,
          'message' => 'jenis not found'
        ], 404);
      }
    }
  }
  // #####
}
