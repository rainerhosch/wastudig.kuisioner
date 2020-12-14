<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuisioner extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			// redirect(base_url());
			$data['awal'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'AWAL'))->row_array();
			$this->load->view('menu_awal', $data);
		} else {
			if ($this->session->userdata('role') != "1") {
				if ($this->session->userdata('role') != "3") {
					redirect(base_url('Dashboard_user/dashboard_mhs'));
				} else {
					redirect(base_url('Dashboard_user'));
				}
			} else {
				redirect(base_url('Kuisioner/dashboard'));
			}
		}
	}

	function login_admin()
	{
		$this->load->view('admin/login');
	}

	function proses_login_admin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->M_login->login("wastu_admin", $where)->num_rows();
		if ($cek > 0) {
			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'role' => "1"
			);
			$this->session->set_userdata($data_session);
			echo 'true';
		} else {
			echo 'false';
		}
	}

	function logout()
	{

		$this->session->sess_destroy();
		redirect(base_url());
	}

	function dashboard()
	{
		// echo "login dashboard";
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
				$data['dsbr_adm'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'DSBR_ADM'))->row_array();
				$data['jumlah_kompetensi'] = $this->db->get('k__kompetensi')->num_rows();
				$data['jumlah_pertanyaan'] = $this->db->get('k__master_pertanyaan')->num_rows();
				$this->load->view('admin/dashboard', $data);
			}
		}
	}

	function login_mhs()
	{
		$this->load->view('mhs/login_mhs');
	}

	function proses_login_mhs()
	{
		$nipd = $this->input->post('nim');
		$password = $this->input->post('password');
		$where = array(
			'nipd' => $nipd,
			'password' => md5($password)
		);
		$cek = $this->M_login->login_mhs("mahasiswa_pt", $where)->num_rows();
		if ($cek > 0) {
			$data_session = array(
				'nim' => $nipd,
				'status' => "login",
				'role' => "4"
			);
			$this->session->set_userdata($data_session);
			echo 'true';
		} else {
			echo 'false';
		}
	}

	function login_kaprodi()
	{
		$this->load->view('kaprodi/login_user');
	}

	function proses_login_kaprodi()
	{
		$nidn = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'nidn' => $nidn,
			'password' => md5($password)
		);
		$cek = $this->M_login->login_user("dosen", $where)->num_rows();
		if ($cek > 0) {
			$cek_user = $this->M_login->cek_dosen($nidn);
			$id_ptk = $cek_user->id_ptk;
			$cek_kaprodi = $this->M_login->cek_kaprodi($id_ptk)->num_rows();
			if ($cek_kaprodi > 0) {
				$row = $this->db->query("SELECT max(j.id_tahun) tahun,
						                          j.id_jur, 
						                          d.nm_ptk
						                 FROM dosen d
										 JOIN dosen_pt d_pt on d.id_ptk=d_pt.id_ptk 
										 JOIN k__jawaban j on j.id_jur=d_pt.id_sms 
										 WHERE d.nidn='" . $nidn . "'")->row_array();

				$data_session = array(
					'tahun' => $row['tahun'],
					'nama' => $row['nm_ptk'],
					//'jabatan' => $row['Jabatan_ID'],
					'id_jur' => $row['id_jur'],
					'username' => $nidn,
					'status' => "login",
					'role' => "3"
				);

				$this->session->set_userdata($data_session);

				echo 'true';
			} else {
				echo 'false';
			}
		} else {
			echo 'false1';
		}
	}


	function proses_login_lkm()
	{
		$jabatan = 'LKM';
		$nidn = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'nidn' => $nidn,
			'password' => md5($password)
		);
		$cek = $this->M_login->login_user("dosen", $where)->num_rows();
		if ($cek > 0) {
			$cek_user = $this->M_login->cek_dosen($nidn);
			$id_jabatan = $cek_user->id_jabatan_struktural;
			// cek jabatan LKM
			$cek_lkm = $this->M_login->cek_jabatan($id_jabatan);
			if ($cek_lkm->jabatan == $jabatan) {
				$row = $this->db->query("SELECT max(j.id_tahun) tahun,
											j.id_jur,
											d.nm_ptk
										FROM dosen d
										JOIN dosen_pt d_pt on d.id_ptk=d_pt.id_ptk
										JOIN k__jawaban j on j.id_jur=d_pt.id_sms
										WHERE d.nidn='" . $nidn . "'")->row_array();

				$data_session = array(
					'tahun' => $row['tahun'],
					'nama' => $row['nm_ptk'],
					'jabatan' => $cek_lkm->id_jabatan,
					// 'id_jur' => $row['id_jur'],
					'username' => $nidn,
					'status' => "login",
					'role' => "3"
				);

				$this->session->set_userdata($data_session);

				echo 'true';
			} else {
				echo 'false';
			}
		} else {
			echo 'false';
		}
	}

	function login_lkm()
	{
		$this->load->view('LKM/login_lkm');
	}
}
