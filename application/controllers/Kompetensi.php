<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Kompetensi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('M_kompetensi');
    $this->load->library('form_validation');
  }

  public function index()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      if ($this->session->userdata('role') != "1") {
        if ($this->session->userdata('role') != "3") {
          redirect(base_url('Dashboard_user/dashboard_mhs'));
        } else {
          redirect(base_url('Dashboard_user'));
        }
      } else {
        $this->load->view('admin/kuesioner/kompetensi_list');
      }
    }
  }

  // datatable
  public function fetch_kompetensi()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      $fetch_data = $this->M_kompetensi->buat_datatable();
      $data = array(); //mendefinisikan variable $data sebagai array
      $no = 1;         // mendefinisikan variable $no dan memberikan value 1
      foreach ($fetch_data as $row) {
        $sub_array   = array();
        $sub_array[] = $no++;
        $sub_array[] = $row->kompetensi;
        $sub_array[] = '<button type="button" name="update" id="' . $row->id_kompetensi . '" class="btn btn-warning btn-sm update"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                         <button type="button" name="delete" id="' . $row->id_kompetensi . '" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i> Hapus</button>';
        $data[]      = $sub_array;
      }

      $output = array(
        "draw"            => intval($_POST["draw"]),
        "recordsTotal"    => $this->M_kompetensi->get_all_data(), //mengambil total record
        "recordsFiltered" => $this->M_kompetensi->get_filtered_data(), //record yang difilter
        "data"            => $data
      );

      echo json_encode($output);
    }
  }

  //insert dan update action
  function input_action()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      if ($_POST["action"] == "Simpan") { // jika ctionnya bernilai 'Simpan' maka akan dilakukan insert data baru
        $insert_data = array(
          'kompetensi'     => $this->input->post('kompetensi')
        );
        $this->M_kompetensi->insert_action($insert_data);
        echo 'Data tersimpan!';
      }

      if ($_POST["action"] == "Edit") {  // jika ctionnya bernilai 'edit' maka akan dilakukan update data
        $update_data = array(
          'kompetensi'     => $this->input->post('kompetensi')
        );
        $this->M_kompetensi->update_action($this->input->post("id_kompetensi"), $update_data);
        echo 'Data terupdate!';
      }
    }
  }

  //mengambil data tunggal untuk edit
  function fetch_single_data()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      $output = array();
      $data = $this->M_kompetensi->fetch_single_data($_POST["id_kompetensi"]);
      foreach ($data as $row) {
        $output['kompetensi'] = $row->kompetensi;
      }
      echo json_encode($output);
    }
  }

  // delete data
  function delete_single_data()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      $this->M_kompetensi->delete_action($_POST["id_kompetensi"]);
      echo "Data berhasil di hapus";
    }
  }
}
