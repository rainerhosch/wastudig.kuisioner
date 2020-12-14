<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_kriteria');
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
				$data['record'] = $this->M_kriteria->get_kriteria()->result_array();
				$data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
				$this->load->view('admin/kuesioner/kriteria_list', $data);
			}
		}
	}

	function ajax_list()
	{
		$list = $this->M_kriteria->buat_datatable()->result_array();
		$data = array();
		$no = 1;
		foreach ($list as $r) {
			$row = array();
			$row[] = "<input type='checkbox' class='data-check' value='" . $r['id_kriteria'] . "' onclick='showBottomDelete()'/>";
			$row[] = $no;
			$row[] = $r['id_tahun'];
			$row[] = $r['nilai_from'];
			$row[] = $r['nilai_to'];
			$row[] = $r['kategori'];
			//add html for action
			$row[] = "
	          			<a class='btn btn-sm btn-warning update' onclick='edit(" . '"' . $r['id_kriteria'] . '"' . ")'><i class='glyphicon glyphicon-pencil'></i> Edit</a> 
                        <a class='btn btn-sm btn-danger' onclick='hapus(" . '"' . $r['id_kriteria'] . '"' . ")'><i class='glyphicon glyphicon-trash'></i> Hapus</a>
                        <a class='btn btn-sm btn-success' onclick='duplicate(" . '"' . $r['id_kriteria'] . '"' . ")' ><i class='glyphicon glyphicon-duplicate'></i> Duplikat</a>
                        ";
			$data[] = $row;
			$no++;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_kriteria->count_all(),
			"recordsFiltered" => $this->M_kriteria->get_filtered_data(), //record yang difilter
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	function input_action()
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
				if (isset($_POST['submit'])) {
					$tahun = $this->input->post('tahun');
					for ($i = 1; $i <= 5; $i++) {
						$nilai_dari = $this->input->post('nilai_dari' . $i);
						$nilai_sampai = $this->input->post('nilai_sampai' . $i);
						$kategori = $this->input->post('kategori' . $i);
						if ($nilai_dari != '' && $nilai_sampai != '' && $kategori != '') {
							$data = array(
								'id_tahun' => $tahun,
								'nilai_from' => $nilai_dari,
								'nilai_to' => $nilai_sampai,
								'kategori' => $kategori
							);

							$this->M_kriteria->input_action($data);
						}
					}
					redirect(base_url('Kriteria'));
				} else {
					$data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
					$this->load->view('admin/kuesioner/tambah_kriteria', $data);
				}
			}
		}
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
					$nilai_dari = $this->input->post('nilai_dari' . $i);
					$nilai_sampai = $this->input->post('nilai_sampai' . $i);
					$kategori = $this->input->post('kategori' . $i);
					if ($nilai_dari != '' && $nilai_sampai != '' && $kategori != '') {
						$data = array(
							'id_tahun' => $tahun,
							'nilai_from' => $nilai_dari,
							'nilai_to' => $nilai_sampai,
							'kategori' => $kategori
						);

						$this->M_kriteria->input_action($data);
					}
				}
				redirect(base_url('Kriteria'));
			}
		}
	}

	function update_action()
	{
		$id_kriteria = $this->input->post('id_kriteria');
		$tahun = $this->input->post('tahun');
		$nilai_dari = $this->input->post('dari_rata');
		$nilai_sampai = $this->input->post('sampai_rata');
		$kategori = $this->input->post('kategori');
		$data = array(
			'id_tahun' => $tahun,
			'nilai_from' => $nilai_dari,
			'nilai_to' => $nilai_sampai,
			'kategori' => $kategori
		);
		$this->M_kriteria->update_action($data, $id_kriteria);
		echo json_encode(array("status" => TRUE));
	}

	function delete_action($id_kriteria)
	{
		if ($this->session->userdata('status') != "login") {
			redirect(base_url());
		} else {
			$this->M_kriteria->delete_action($id_kriteria);
			echo json_encode(array("status" => TRUE));
		}
	}

	function ajax_list_delete()
	{
		$list_id = $this->input->post('id');
		foreach ($list_id as $id_kriteria) {
			$this->M_kriteria->delete_action($id_kriteria);
		}
		echo json_encode(array("status" => TRUE));
	}

	function get_one_tahun($tahun)
	{
		$data['tahun_pilih'] = $tahun;
		$data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result();
		$data['record'] = $this->db->get_where('k__kriteria_nilai', array('id_tahun' => $tahun))->result_array();
		$data['jum_record'] = $this->db->get_where('k__kriteria_nilai', array('id_tahun' => $tahun))->num_rows();
		$this->load->view('admin/kuesioner/duplikat', $data);
	}

	function get_one($id)
	{
		$data = $this->M_kriteria->get_one($id)->row_array();
		echo json_encode($data);
	}

	function duplicate()
	{
		$data = array(
			'id_tahun' => $this->input->post('tahun'),
			'nilai_from' => $this->input->post('dari_rata'),
			'nilai_to' => $this->input->post('sampai_rata'),
			'kategori' => $this->input->post('kategori')
		);
		$this->M_kriteria->input_action($data);
		echo json_encode(array("status" => TRUE));
	}
}
