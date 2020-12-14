<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_penilaian extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_data_krs_ok($nim)
    {
        $this->db->select_max('id_tahun_ajaran');
        $this->db->where('nipd', $nim);
        $max = $this->db->get('krs_new');
        $query = $this->db->query("SELECT k.id_krs, 
                                         mk.kode_mk,
                                         mk.nm_mk, 
                                         jr.nm_jur, 
                                         k.id_tahun_ajaran, 
                                         kl.nama_kelas, 
                                         k.smtr, 
                                         d.nm_ptk, 
                                         k.id_dosen, 
                                         k.id_jurusan, 
                                         k.nipd, 
                                         k.id_mk, 
                                         d.NIDN
                                    FROM krs_new k
                                    JOIN mata_kuliah mk ON mk.id_mk=k.id_mk
                                    JOIN jurusan jr ON jr.id_jur=k.id_jurusan
                                    JOIN wastu_kelas kl ON kl.id_kelas=k.kode_kelas
                                    JOIN dosen d ON d.id_ptk=k.id_dosen
                                    WHERE k.nipd='" . $nim . "' AND k.id_tahun_ajaran='" . $max->row()->id_tahun_ajaran . "' GROUP BY id_krs");
        return $query;
    }

    function sum_belum_dinilai($nipd)
    {
        $this->db->select_max('id_tahun_ajaran');
        $this->db->where('nipd', $nipd);
        $max = $this->db->get('krs_new');

        $krs = $this->db->query("SELECT id_krs FROM krs_new WHERE nipd='" . $nipd . "' AND id_tahun_ajaran='" . $max->row()->id_tahun_ajaran . "'")->num_rows();

        $status = $this->db->query("SELECT id_status FROM k__status_kuesioner  WHERE nim='" . $nipd . "' AND id_tahun='" . $max->row()->id_tahun_ajaran . "'")->num_rows();

        $hasil = $krs - $status;
        return $hasil;
    }

    function get_data_terisi($nipd)
    {
        $query = $this->db->query("SELECT jb.id_jawaban, 
                                        d.nm_ptk, 
                                        jb.id_tahun, 
                                        mk.nm_mk, 
                                        jb.id_tahun, 
                                        k.smtr, 
                                        kl.nama_kelas, 
                                        jb.id_krs
                                FROM k__jawaban jb
                                JOIN mata_kuliah mk ON mk.Kode_mk=jb.kode_mtk
                                JOIN wastu_kelas kl ON kl.id_kelas=jb.id_kelas
                                JOIN dosen d ON d.NIDN=jb.nidn
                                JOIN krs_new k ON k.id_krs=jb.id_krs
                                WHERE jb.nim='" . $nipd . "' GROUP BY jb.nidn, jb.id_jur, jb.id_tahun, jb.kode_mtk");
        return $query;
    }

    function get_one_krs_ok($id_krs)
    {
        $param = array('id_krs' => $id_krs);
        $query = $this->db->query("SELECT d.nidn, 
                                        d.nm_ptk,
                                        k.id_dosen,
                                        k.kode_kelas,
                                        k.id_tahun_ajaran,
                                        k.id_krs,
                                        k.id_jurusan,
                                        mk.nm_mk,
                                        mk.kode_mk
                                 FROM krs_new k
                                 JOIN dosen d ON d.id_ptk=k.id_dosen
                                 JOIN mata_kuliah mk ON mk.id_mk=k.id_mk
                                 JOIN mahasiswa_pt m_pt ON m_pt.nipd=k.nipd
                                 WHERE id_krs = " . $id_krs);

        return $query;
        //$this->db->select('*')->from('krs_new')->join('dosen', 'dosen.id_ptk=krs_new.id_dosen')->join('mata_kuliah', 'mata_kuliah.id_mk=krs_new.id_mk')->join('mahasiswa_pt', 'mahasiswa_pt.nipd=krs_new.nipd')->where($param)->get();
    }

    function get_data_mhs($nim)
    {
        $query = $this->db->query("SELECT m_pt.nipd, m.nm_pd, jr.nm_jur, d.nm_ptk
                                  FROM mahasiswa_pt m_pt 
                                  LEFT JOIN mahasiswa m ON m_pt.id_pd=m.id_pd
                                  LEFT JOIN jurusan jr ON m_pt.id_sms=jr.id_jur
                                  LEFT JOIN dosen d ON m_pt.id_ptk=d.id_ptk 
                                  WHERE m_pt.nipd='" . $nim . "'");
        return $query;
    }

    function cek_jumlah_jawaban($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function get_sum_jawaban($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function update_sum_jawaban($data_update, $id_sum)
    {
        $this->db->where('id_sum', $id_sum);
        $this->db->update('k__sum_jawaban', $data_update);
    }
}
