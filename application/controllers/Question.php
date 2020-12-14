<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Question extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('M_question');
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
        // redirect(base_url('Kuisioner/dashboard'));
        $data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
        $data['kompetensi'] = $this->db->get('k__kompetensi')->result();
        $this->load->view('admin/kuesioner/kuesioner_list', $data);
      }
    }
  }

  function ajax_list()
  {
    $list = $this->M_question->buat_datatable()->result_array();
    $data = array();
    $no = 1;
    foreach ($list as $r) {
      $row = array();
      $row[] = "<input type='checkbox' class='data-check' value='" . $r['id_pertanyaan'] . "' onclick='showBottomDelete()'/>";
      $row[] = $no;
      $row[] = $r['kompetensi'];
      $row[] = $r['pertanyaan'];
      $row[] = $r['id_tahun'];
      //add html for action
      $row[] = "
                  <a class='btn btn-sm btn-warning update' onclick='edit(" . '"' . $r['id_pertanyaan'] . '"' . ")'><i class='glyphicon glyphicon-pencil'></i> Edit</a> 
                        <a class='btn btn-sm btn-danger' onclick='hapus(" . '"' . $r['id_pertanyaan'] . '"' . ")'><i class='glyphicon glyphicon-trash'></i> Hapus</a>
                        <a class='btn btn-sm btn-success' onclick='duplicate(" . '"' . $r['id_pertanyaan'] . '"' . ")' ><i class='glyphicon glyphicon-duplicate'></i> Duplikat</a>
                        ";
      $data[] = $row;
      $no++;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->M_question->count_all(),
      "recordsFiltered" => $this->M_question->get_filtered_data(), //record yang difilter
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }

  function get_one($id)
  {
    $data = $this->M_question->get_one($id)->row_array();
    echo json_encode($data);
  }

  function get_one_tahun($tahun)
  {
    $data['tahun_pilih'] = $tahun;
    $data['kompetensi'] = $this->db->get('k__kompetensi')->result();
    $data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
    $data['record'] = $this->M_question->get_ques_by_th($tahun)->result_array();
    $data['jum_record'] = $this->M_question->get_data_ques_by_th($tahun)->num_rows();
    $this->load->view('admin/kuesioner/duplikat_ques', $data);
  }

  function duplicate()
  {
    $kompetensi = $this->input->post('kompetensi');
    $pertanyaan = $this->input->post('pertanyaan');
    $tahun = $this->input->post('tahun');
    if ($pertanyaan != "") {
      $data = array(
        'id_kompetensi' => $kompetensi,
        'pertanyaan'    => $pertanyaan,
        'id_tahun'      => $tahun
      );
      $this->M_question->input_action($data);
    }
    echo json_encode(array("status" => TRUE));
  }

  function duplicate_by_th()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      if (isset($_POST['submit'])) {
        $no = $this->input->post('no');
        $tahun = $this->input->post('tahun');
        for ($i = 1; $i < $no; $i++) {
          $kompetensi = $this->input->post('kompetensi' . $i);
          $pertanyaan = $this->input->post('pertanyaan' . $i);
          if ($pertanyaan != '') {
            $data = array(
              'id_kompetensi' => $kompetensi,
              'pertanyaan'    => $pertanyaan,
              'id_tahun'      => $tahun
            );
            $this->M_question->input_action($data);
          }
        }
        redirect(base_url('Question'));
      }
    }
  }

  function input_action()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      if (isset($_POST['submit'])) {
        //proses tambah
        $kompetensi = $this->input->post('kompetensi');
        $tahun = $this->input->post('tahun');
        for ($i = 1; $i <= 10; $i++) {
          $pertanyaan = $this->input->post('pertanyaan' . $i);
          if ($pertanyaan != "") {
            $data = array(
              'id_kompetensi' => $kompetensi,
              'pertanyaan'    => $pertanyaan,
              'id_tahun'      => $tahun
            );
            $this->M_question->input_action($data);
          }
        }
        redirect(base_url('Question'));
        echo "<script> alert('Stored successfully'); </script>";
      } else {
        $data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
        $data['kompetensi'] = $this->db->get('k__kompetensi')->result();
        $this->load->view('admin/kuesioner/tambah_kuesioner', $data);
      }
    }
  }

  function update_action()
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      //proses edit 
      $id_pertanyaan = $this->input->post('id_pertanyaan');
      $kompetensi = $this->input->post('kompetensi');
      $pertanyaan = $this->input->post('pertanyaan');
      $tahun = $this->input->post('tahun');
      $data = array(
        'id_kompetensi' => $kompetensi,
        'pertanyaan'    => $pertanyaan,
        'id_tahun'      => $tahun
      );
      $this->M_question->update_action($data, $id_pertanyaan);
      echo json_encode(array("status" => TRUE));
    }
  }

  function delete_action($id_pertanyaan)
  {
    if ($this->session->userdata('status') != "login") {
      redirect(base_url());
    } else {
      $this->M_question->delete_action($id_pertanyaan);
      echo json_encode(array("status" => TRUE));
    }
  }

  function ajax_list_delete()
  {
    $list_id = $this->input->post('id');
    foreach ($list_id as $id_pertanyaan) {
      $this->M_question->delete_action($id_pertanyaan);
    }
    echo json_encode(array("status" => TRUE));
  }
}
