<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Inbox extends RestController
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Inbox_model', 'inbox');
  }

  // Read Inbox
  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $inbox = $this->inbox->get_Inbox();
    } else {
      $inbox = $this->inbox->get_Inbox($id);
    }
    if ($inbox) {
      $this->response([
        'status' => true,
        'data' => $inbox,
        'message' => 'All inbox is viewed'
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Inbox not found'
      ], 404);
    }
  }
  // #####

  // Create Inbox
  public function index_post()
  {
    $data = [
      'pengirim' => $this->input->post('pengirim'),
      'no_surat' => $this->input->post('no_surat'),
      'jenis_id' => $this->input->post('jenis_id'),
      'perihal' => $this->input->post('perihal'),
      'tgl_masuk' => $this->input->post('tgl_masuk'),
      'tgl_kegiatan' => $this->input->post('tgl_kegiatan'),
      'file' => $this->input->post('file')
    ];
    if ($this->inbox->create_Inbox($data) > 0) {
      $this->response([
        'status' => true,
        'message' => 'Inbox has been created successfully.'
      ], 201);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Failed to create Inbox '
      ], 403);
    }
  }
  // #####

  // Update Inbox
  public function index_put()
  {
    $id = $this->put('id');
    $data = [
      'pengirim' => $this->put('pengirim'),
      'no_surat' => $this->put('no_surat'),
      'jenis_id' => $this->put('jenis_id'),
      'perihal' => $this->put('perihal'),
      'tgl_masuk' => $this->put('tgl_masuk'),
      'tgl_kegiatan' => $this->put('tgl_kegiatan'),
      'file' => $this->put('file')
    ];

    if ($this->inbox->update_Inbox($data, $id) > 0) {
      $this->response([
        'status' => true,
        'message' => 'Inbox has been updated successfully.'
      ], 204);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Failed to update Inbox'
      ], 502);
    }
  }
  // #####

  // Delete Inbox
  public function index_delete()
  {
    $id = $this->delete('id');
    if ($id === null) {
      $this->response([
        'status' => false,
        'message' => 'Provide an Inbox'
      ], 502);
    } else {
      if ($this->inbox->delete_Inbox($id) > 0) {
        $this->response([
          'status' => true,
          'message' => 'Inbox has been deleted successfully.'
        ], 204);
      } else {
        $this->response([
          'status' => false,
          'message' => 'Inbox not found'
        ], 404);
      }
    }
  }
  // #####
}
