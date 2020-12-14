<?php

/**
 * 
 */
class Penilaian extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_penilaian');
		$this->load->model('M_question');
		$this->load->model('M_pilihan');
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect(base_url());
		} else {
			if ($this->session->userdata('role') != "1") {
				if ($this->session->userdata('role') != "3") {
					// redirect(base_url('Dashboard_user/dashboard_mhs'));
					$nim = $this->session->userdata('nim');
					$data['mhs'] = $this->M_penilaian->get_data_mhs($nim)->row_array();
					$data['record'] = $this->M_penilaian->get_data_krs_ok($nim)->result_array();
					$this->load->view('mhs/awal_penilaian', $data);
				} else {
					redirect(base_url('Dashboard_user'));
				}
			} else {
				redirect(base_url('Kuisioner/dashboard'));
			}
		}
	}

	function penilaian()
	{
		if ($this->session->userdata('status') != "login") {
			redirect(base_url());
		} else {
			if ($this->session->userdata('role') != "1") {
				if ($this->session->userdata('role') != "3") {
					// redirect(base_url('Dashboard_user/dashboard_mhs'));
					$id_krs = $this->uri->segment(3);
					$tahun = $this->db->query("SELECT id_tahun_ajaran FROM krs_new WHERE id_krs=" . $id_krs . "")->row()->id_tahun_ajaran;
					$data['record'] = $this->M_penilaian->get_one_krs_ok($id_krs)->row_array();
					$data['kuesioner'] = $this->M_question->get_data_ques_by_th($tahun)->result_array();
					$data['pilihan'] = $this->M_pilihan->get_pilihan_by_th($tahun)->result_array();
					$data['jum_kuesioner'] = $this->M_question->get_data_ques_by_th($tahun)->num_rows();
					$data['jum_pilihan'] = $this->M_pilihan->get_pilihan_by_th($tahun)->num_rows();
					$data['cara_isi'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'CARA_ISI'))->row_array();
					$this->load->view('mhs/menu_penilaian', $data);
				} else {
					redirect(base_url('Dashboard_user'));
				}
			} else {
				redirect(base_url('Kuisioner/dashboard'));
			}
		}
	}

	function input_action()
	{
		if ($this->session->userdata('status') != "login") {
			redirect(base_url());
		} else {
			// if (isset($_POST['submit'])) {
			$responden = 1;
			$jumlah = $this->input->post('jumlah');
			$nidn = $this->input->post('nidn1');
			$id_dosen = $this->input->post('id_dosen');
			$id_krs = $this->input->post('id_krs');
			$kd_kelas = $this->input->post('kd_kelas');
			$tahun = $this->input->post('id_tahun');
			$kd_matkul = $this->input->post('kode_matkul');
			$jurusan = $this->input->post('jurusan');
			$nim = $this->session->userdata('nim');
			if ($jumlah != 1) {
				for ($i = 1; $i < $jumlah; $i++) {
					$kompetensi = $this->input->post('kompetensi' . $i);
					$pertanyaan = $this->input->post('pertanyaan' . $i);
					$jawaban = $this->input->post('Radio' . $i);

					$data = array(
						'id_krs' => $id_krs,
						'nidn' => $nidn,
						'id_jur' => $jurusan,
						'id_tahun' => $tahun,
						'id_kelas' => $kd_kelas,
						'kode_mtk' => $kd_matkul,
						'nim' => $nim,
						'id_kompetensi' => $kompetensi,
						'id_pertanyaan' => $pertanyaan,
						'jawaban' => $jawaban
					);

					$this->db->insert('k__jawaban', $data);

					$where = array(
						'nidn' => $nidn,
						'id_jur' => $jurusan,
						'kode_mtk' => $kd_matkul,
						'id_tahun' => $tahun,
						'id_kompetensi' => $kompetensi
					);
					$cek = $this->M_penilaian->cek_jumlah_jawaban('k__sum_jawaban', $where)->num_rows(); //cek table sum_jawaban
					$jumlah_ques = $this->db->query("SELECT pertanyaan
		 										FROM k__master_pertanyaan
		 										WHERE id_kompetensi=" . $kompetensi . " AND id_tahun=" . $tahun . "")->num_rows();
					$responden = $this->db->query("SELECT nim 
		 									FROM k__jawaban 
		 									WHERE id_jur ='" . $jurusan . "' AND nidn='" . $nidn . "' AND id_tahun='" . $tahun . "' AND kode_mtk='" . $kd_matkul . "' GROUP BY nim")->num_rows();

					if ($cek == 0) {
						$rata_per_komp = ($jawaban / $jumlah_ques) / $responden;
						$kategori = $this->db->query("SELECT kategori 
		 								FROM k__kriteria_nilai
		 								WHERE id_tahun=" . $tahun . " AND " . $rata_per_komp . " BETWEEN nilai_from AND nilai_to ")->row_array();
						$data_sum = array(
							'nidn' => $nidn,
							'id_jur' => $jurusan,
							'kode_mtk' => $kd_matkul,
							'id_tahun' => $tahun,
							'id_kompetensi' => $kompetensi,
							'jumlah' => $jawaban,
							'rata_per_kompetensi' => $rata_per_komp,
							'kategori_per_komp' => $kategori['kategori']
						); // insert rata-rata per kompetensi

						$this->db->insert('k__sum_jawaban', $data_sum);
					} else if ($cek > 0) {
						$rows = $this->M_penilaian->get_sum_jawaban('k__sum_jawaban', $where)->row_array();
						$id_sum = $rows['id_sum'];
						$rata_per_komp = (($rows['jumlah'] + $jawaban) / $jumlah_ques) / $responden;
						$kategori = $this->db->query("SELECT kategori 
		 								FROM k__kriteria_nilai
		 								WHERE id_tahun=" . $tahun . " AND " . $rata_per_komp . " BETWEEN nilai_from AND nilai_to ")->row_array();
						$data_update = array(
							'id_sum' => $id_sum,
							'nidn' => $nidn,
							'id_jur' => $jurusan,
							'kode_mtk' => $kd_matkul,
							'id_tahun' => $tahun,
							'id_kompetensi' => $kompetensi,
							'jumlah' => $rows['jumlah'] + $jawaban,
							'rata_per_kompetensi' => $rata_per_komp,
							'kategori_per_komp' => $kategori['kategori']
						);

						$this->M_penilaian->update_sum_jawaban($data_update, $id_sum);
					}
				} //end for looping

				$data_status = array(
					'id_krs' => $id_krs,
					'nim' => $nim,
					'id_tahun' => $tahun,
					'nidn' => $nidn,
					'id_dosen' => $id_dosen,
					'id_jur' => $jurusan,
					'kode_mtk' => $kd_matkul
				);
				$this->db->insert('k__status_kuesioner', $data_status); //insert status kuesioner

				//table sum_jawaban
				$param = array(
					'nidn' => $nidn,
					'id_jur' => $jurusan,
					'kode_mtk' => $kd_matkul,
					'id_tahun' => $tahun
				);
				$sum_all = $this->db->select_sum('jumlah')->from('k__sum_jawaban')->where($param)->get();
				$jumlah_ques = $this->db->select('pertanyaan')->from('k__master_pertanyaan')->where(array('id_tahun' => $tahun))->get()->num_rows();
				$responden = $this->db->select('nim')->from('k__status_kuesioner')->where($param)->get()->num_rows();
				$rata_all = ($sum_all->row()->jumlah / $responden) / $jumlah_ques;

				$kategori = $this->db->query("SELECT kategori 
		 								FROM k__kriteria_nilai
		 								WHERE id_tahun=" . $tahun . " AND " . $rata_all . " BETWEEN nilai_from AND nilai_to ")->row_array();
				$this->db->where($param)->update('k__sum_jawaban', array('rata_keseluruhan' => $rata_all, 'kategori' => $kategori['kategori'], 'responden' => $responden));

				$this->hasil_perdosen($nidn, $jurusan, $tahun);
				$this->hasil_pertahun_jur($jurusan, $tahun);

				redirect(base_url('Penilaian/after_penilaian'));
			} // end if
			/*else{
		 	 	redirect(base_url('Penilaian'));
		 	}
		 } //end if(isset($_POST['submit']))*/
			// echo json_encode(array("status" => TRUE));
		} //end else
	}

	function hasil_perdosen($nidn, $jurusan, $tahun)
	{
		$where = array(
			'nidn' => $nidn,
			'id_jur' => $jurusan,
			'id_tahun' => $tahun
		);
		$cek = $this->M_penilaian->cek_jumlah_jawaban('k__hasil_pertahun_dos', $where)->num_rows();

		$all_rata = $this->db->query("SELECT SUM(rata_keseluruhan) AS all_rata
									FROM ( 
									SELECT * FROM k__sum_jawaban 
									WHERE nidn='" . $nidn . "' AND id_jur='" . $jurusan . "' AND id_tahun='" . $tahun . "' 
									GROUP BY nidn,kode_mtk,id_tahun) sq ");
		$jum_mtk = $this->db->query("SELECT kode_mtk
									FROM k__sum_jawaban
									WHERE nidn='" . $nidn . "' AND id_jur='" . $jurusan . "' AND id_tahun='" . $tahun . "'
									GROUP BY nidn,kode_mtk,id_tahun")->num_rows();
		$hasil = $all_rata->row()->all_rata / $jum_mtk;
		$kategori = $this->db->query("SELECT kategori 
		 							FROM k__kriteria_nilai
		 							WHERE id_tahun=" . $tahun . " AND " . $hasil . " BETWEEN nilai_from AND nilai_to ")->row_array();

		if ($cek == 0) {
			$data = array(
				'nidn' => $nidn,
				'id_jur' => $jurusan,
				'id_tahun' => $tahun,
				'rata_rata' => $hasil,
				'kategori' => $kategori['kategori']
			);
			$this->db->insert('k__hasil_pertahun_dos', $data);
		} else if ($cek > 0) {
			$rows = $this->db->select('*')->from('k__hasil_pertahun_dos')->where($where)->get()->row_array();
			$id_perdos = $rows['id_perdos'];
			$data = array(
				'nidn' => $nidn,
				'id_jur' => $jurusan,
				'id_tahun' => $tahun,
				'rata_rata' => $hasil,
				'kategori' => $kategori['kategori']
			);
			$this->db->where('id_perdos', $id_perdos)->update('k__hasil_pertahun_dos', $data);
		}
	}

	function hasil_pertahun_jur($jurusan, $tahun)
	{
		$where = array(
			'id_jur' => $jurusan,
			'id_tahun' => $tahun
		);
		$cek = $this->M_penilaian->cek_jumlah_jawaban('k__hasil_pertahun_jur', $where)->num_rows(); //cek table hasi
		$all_rata = $this->db->select_sum('rata_rata')->from('k__hasil_pertahun_dos')->where($where)->get();
		$jum_dosen = $this->db->select('nidn')->from('k__hasil_pertahun_dos')->where($where)->get()->num_rows();
		$hasil = $all_rata->row()->rata_rata / $jum_dosen;
		$kategori = $this->db->query("SELECT kategori 
		 							FROM k__kriteria_nilai
		 							WHERE id_tahun=" . $tahun . " AND " . $hasil . " BETWEEN nilai_from AND nilai_to ")->row_array();

		if ($cek == 0) {
			$data = array(
				'id_jur' => $jurusan,
				'id_tahun' => $tahun,
				'rata_rata' => $hasil,
				'kategori' => $kategori['kategori']
			);
			$this->db->insert('k__hasil_pertahun_jur', $data);
		} else if ($cek > 0) {

			$rows = $this->db->query("SELECT * FROM k__hasil_pertahun_jur WHERE id_jur='" . $jurusan . "' AND id_tahun=" . $tahun . "")->row_array();
			$id_hasil = $rows['id_hasil'];
			$data = array(
				'id_jur' => $jurusan,
				'id_tahun' => $tahun,
				'rata_rata' => $hasil,
				'kategori' => $kategori['kategori']
			);
			$this->db->where('id_hasil', $id_hasil)->update('k__hasil_pertahun_jur', $data);
		}
	}

	function after_penilaian()
	{
		if ($this->session->userdata('status') != "login") {
			redirect(base_url());
		} else {
			if ($this->session->userdata('role') != "1") {
				if ($this->session->userdata('role') != "3") {
					// redirect(base_url('Dashboard_user/dashboard_mhs'));
					$nim = $this->session->userdata('nim');
					$data['record'] = $this->M_penilaian->get_data_terisi($nim)->result_array();
					$this->load->view('mhs/after_penilaian', $data);
				} else {
					redirect(base_url('Dashboard_user'));
				}
			} else {
				redirect(base_url('Kuisioner/dashboard'));
			}
		}
	}
}
