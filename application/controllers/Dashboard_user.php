<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_user extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_penilaian');
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
                    // redirect(base_url('Dashboard_user'));
                    if ($this->session->userdata('jabatan') != "6") { //untuk kaprodi
                        $id_jur = $this->session->userdata("id_jur");
                        $tahun = $this->db->select_max('id_tahun')->from('k__hasil_pertahun_dos')->where(array('id_jur' => $id_jur))->get();
                        $tahun_hasil = $tahun->row()->id_tahun;
                        $query = $this->db->query("SELECT hpd.id_perdos, 
                                                    d.nm_ptk, 
                                                    d.NIDN, 
                                                    hpd.id_jur, 
                                                    jr.nm_jur, 
                                                    hpd.id_tahun, 
                                                    hpd.rata_rata, 
                                                    hpd.kategori
                                            FROM k__hasil_pertahun_dos hpd
                                            JOIN dosen d ON d.nidn=hpd.nidn
                                            JOIN jurusan jr ON jr.id_jur=hpd.id_jur
                                            WHERE id_tahun='" . $tahun_hasil . "'  AND hpd.id_jur='" . $id_jur . "'
                                            ")->result();
                        $data['jurusan'] = $this->db->query("SELECT hpd.id_jur, 
                                                              jr.nm_jur
                                                       FROM k__hasil_pertahun_dos hpd
                                                       JOIN jurusan jr ON jr.id_jur=hpd.id_jur AND hpd.id_jur='" . $id_jur . "'")->row_array();

                        $data['tahun_record'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result_array();
                        $data['tahun'] = $tahun_hasil;
                        $data['query'] = $query;
                        $this->load->view('kaprodi/dashboard', $data);
                    } else {  //untuk LKM
                        $tahun = $this->db->select_max('id_tahun')->from('k__hasil_pertahun_jur')->get();
                        $tahun_hasil = $tahun->row()->id_tahun;
                        $query = $this->db->query("SELECT hpj.id_hasil, 
                                                    hpj.id_jur, 
                                                    jr.nm_jur, 
                                                    hpj.id_tahun, 
                                                    hpj.rata_rata, 
                                                    hpj.kategori
                                            FROM k__hasil_pertahun_jur hpj
                                            JOIN jurusan jr ON jr.id_jur=hpj.id_jur
                                            WHERE id_tahun='" . $tahun_hasil . "'")->result();
                        $data['tahun_record'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result_array();
                        $data['tahun'] = $tahun_hasil;
                        $data['query'] = $query;
                        $this->load->view('LKM/dashboard', $data);
                    }
                }
            } else {
                redirect(base_url('Kuisioner/dashboard'));
            }
        }
    }

    function dashboard_mhs()
    {
        if ($this->session->userdata('status') != "login") {
            redirect(base_url());
        } else {
            if ($this->session->userdata('role') != "1") {
                if ($this->session->userdata('role') != "3") {
                    // redirect(base_url('Dashboard_user/dashboard_mhs'));
                    $nipd = $this->session->userdata('nim');
                    $data['dsbr_mhs'] = $this->db->get_where('k__catatan_kues', array('id_catatan' => 'DSBR_MHS'))->row_array();
                    $data['jum_ready'] = $this->M_penilaian->sum_belum_dinilai($nipd);
                    $data['jum_terisi'] = $this->M_penilaian->get_data_terisi($nipd)->num_rows();
                    $this->load->view('mhs/dashboard', $data);
                } else {
                    redirect(base_url('Dashboard_user'));
                }
            } else {
                redirect(base_url('Kuisioner/dashboard'));
            }
        }
    }

    function get_one($tahun)
    {
        if ($this->session->userdata('jabatan') != "6") { //untuk kaprodi
            $id_jur = $this->session->userdata("id_jur");
            $query = $this->db->query("SELECT hpd.id_perdos, 
                                            d.nm_ptk, 
                                            d.NIDN, 
                                            hpd.id_jur, 
                                            jr.nm_jur, 
                                            hpd.id_tahun, 
                                            hpd.rata_rata, 
                                            hpd.kategori
                            FROM k__hasil_pertahun_dos hpd
                            JOIN dosen d ON d.NIDN=hpd.nidn
                            JOIN jurusan jr ON jr.id_jur=hpd.id_jur
                            WHERE id_tahun='" . $tahun . "'  AND hpd.id_jur='" . $id_jur . "'
                                        ")->result();
            $data['jurusan'] = $this->db->query("SELECT hpd.id_jur, jr.nm_jur
                                    FROM k__hasil_pertahun_dos hpd
                                    JOIN jurusan jr ON jr.id_jur=hpd.id_jur 
                                    AND hpd.id_jur='" . $id_jur . "'")->row_array();
            $data['tahun_record'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result_array();
            $data['tahun'] = $tahun;
            $data['query'] = $query;
            $this->load->view('kaprodi/dashboard', $data);
        } else { //untuk_LKM
            $query = $this->db->query("SELECT hpj.id_hasil, 
                                            hpj.id_jur, 
                                            jr.nm_jur, 
                                            hpj.id_tahun, 
                                            hpj.rata_rata, 
                                            hpj.kategori
                                    FROM k__hasil_pertahun_jur hpj
                                    JOIN jurusan jr ON jr.id_jur=hpj.id_jur
                                    WHERE id_tahun='" . $tahun . "'")->result();
            $data['tahun_record'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result_array();
            $data['tahun'] = $tahun;
            $data['query'] = $query;
            $this->load->view('LKM/dashboard', $data);
        }
    }

    function get_detail($kode, $tahun)
    {
        $query = $this->db->query("SELECT hpd.id_perdos, 
                                        d.nm_ptk, 
                                        d.NIDN, 
                                        hpd.id_jur, 
                                        jr.nm_jur, 
                                        hpd.id_tahun, 
                                        hpd.rata_rata, 
                                        hpd.kategori
                                FROM k__hasil_pertahun_dos hpd
                                JOIN dosen d ON d.NIDN=hpd.nidn
                                JOIN jurusan jr ON jr.id_jur=hpd.id_jur
                                WHERE id_tahun='" . $tahun . "' AND hpd.id_jur='" . $kode . "'
                                        ")->result();
        $data['jurusan'] = $this->db->query("SELECT hpd.id_jur, jr.nm_jur
                                    FROM k__hasil_pertahun_dos hpd
                                    JOIN jurusan jr ON jr.id_jur=hpd.id_jur 
                                    AND hpd.id_jur='" . $kode . "'")->row_array();
        $data['tahun_record'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result_array();
        $data['tahun'] = $tahun;
        $data['query'] = $query;
        $this->load->view('kaprodi/dashboard', $data);
    }
}
