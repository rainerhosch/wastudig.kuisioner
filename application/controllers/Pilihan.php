<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Pilihan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('M_pilihan');
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
        $data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
        $this->load->view('admin/kuesioner/pilihan_list', $data);
      }
    }
  }

  // datatable
  public function fetch_pilihan()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      $fetch_data = $this->M_pilihan->buat_datatable();
      $data = array(); //mendefinisikan variable $data sebagai array
      $no = 1;         // mendefinisikan variable $no dan memberikan value 1
      foreach ($fetch_data as $row) {
        $sub_array   = array();
        $sub_array[] = $no++;
        $sub_array[] = $row->id_tahun;
        $sub_array[] = "Pilihan 1: " . $row->pilihan1 . " &nbsp &nbsp Pilihan 6: " . $row->pilihan6 . "<br>
                      Pilihan 2: " . $row->pilihan2 . " &nbsp &nbsp Pilihan 7: " . $row->pilihan7 . "<br>
                      Pilihan 3: " . $row->pilihan3 . " &nbsp &nbsp Pilihan 8: " . $row->pilihan8 . "<br>
                      Pilihan 4: " . $row->pilihan4 . " &nbsp &nbsp Pilihan 9: " . $row->pilihan9 . "<br>
                      Pilihan 5: " . $row->pilihan5 . " &nbsp &nbsp Pilihan 10: " . $row->pilihan10 . "";
        $sub_array[] = '<button type="button" name="update" id="' . $row->ID_pilih . '" class="btn btn-warning btn-sm update">
                        <i class="glyphicon glyphicon-pencil"></i> Edit</button>
                         <button type="button" name="delete" id="' . $row->ID_pilih . '" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
                         <button type="button" name="duplikat" id="' . $row->ID_pilih . '" class="btn btn-success btn-sm duplikat"><i class="glyphicon glyphicon-duplicate"></i> Duplikat</button>';
        $data[]      = $sub_array;
      }

      $output = array(
        "draw"            => intval($_POST["draw"]),
        "recordsTotal"    => $this->M_pilihan->get_all_data(), //mengambil total record
        "recordsFiltered" => $this->M_pilihan->get_filtered_data(), //record yang difilter
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
          'id_tahun'    => $this->input->post('tahun'),
          'pilihan1'    => $this->input->post('p1'),
          'pilihan2'    => $this->input->post('p2'),
          'pilihan3'    => $this->input->post('p3'),
          'pilihan4'    => $this->input->post('p4'),
          'pilihan5'    => $this->input->post('p5'),
          'pilihan6'    => $this->input->post('p6'),
          'pilihan7'    => $this->input->post('p7'),
          'pilihan8'    => $this->input->post('p8'),
          'pilihan9'    => $this->input->post('p9'),
          'pilihan10'    => $this->input->post('p10')
        );
        $this->M_pilihan->insert_action($insert_data);
        echo 'Data tersimpan!';
      }

      if ($_POST["action"] == "Edit") {  // jika ctionnya bernilai 'edit' maka akan dilakukan update data
        $update_data = array(
          'id_tahun'     => $this->input->post('tahun'),
          'pilihan1'    => $this->input->post('p1'),
          'pilihan2'    => $this->input->post('p2'),
          'pilihan3'    => $this->input->post('p3'),
          'pilihan4'    => $this->input->post('p4'),
          'pilihan5'    => $this->input->post('p5'),
          'pilihan6'    => $this->input->post('p6'),
          'pilihan7'    => $this->input->post('p7'),
          'pilihan8'    => $this->input->post('p8'),
          'pilihan9'    => $this->input->post('p9'),
          'pilihan10'    => $this->input->post('p10')
        );
        $this->M_pilihan->update_action($this->input->post("id_pilih"), $update_data);
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
      $data = $this->M_pilihan->fetch_single_data($_POST["id_pilih"]);
      foreach ($data as $row) {
        $output['id_tahun'] = $row->id_tahun;
        $output['p1'] = $row->pilihan1;
        $output['p2'] = $row->pilihan2;
        $output['p3'] = $row->pilihan3;
        $output['p4'] = $row->pilihan4;
        $output['p5'] = $row->pilihan5;
        $output['p6'] = $row->pilihan6;
        $output['p7'] = $row->pilihan7;
        $output['p8'] = $row->pilihan8;
        $output['p9'] = $row->pilihan9;
        $output['p10'] = $row->pilihan10;
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
      $this->M_pilihan->delete_action($_POST["id_pilih"]);
      echo "Data berhasil di hapus";
    }
  }
}
