<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Catatan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('M_catatan');
    $this->load->library('form_validation');
  }

  public function index()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      $data['awal'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'AWAL'))->row_array();
      $data['dsbr_adm'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'DSBR_ADM'))->row_array();
      $data['dsbr_mhs'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'DSBR_MHS'))->row_array();
      $data['cara_isi'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'CARA_ISI'))->row_array();
      $this->load->view('admin/kuesioner/catatan_list', $data);
    }
  }

  function update_action()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      if (isset($_POST['submit'])) {
        //proses edit user
        $id_catatan = $this->input->post('id_catatan');
        $catatan = $this->input->post('catatan');
        $data = array(
          'catatan' => $catatan
        );
        $this->M_catatan->update_action($data, $id_catatan);
        redirect(base_url('Catatan'));
      } else {
        $id_catatan = $this->uri->segment(3);
        $data['record']   = $this->M_catatan->get_one($id_catatan)->row_array();
        $this->load->view('admin/kuesioner/edit_catatan', $data);
      }
    }
  }
}
