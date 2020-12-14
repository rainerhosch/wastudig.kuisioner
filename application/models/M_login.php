<?php
class M_login extends CI_Model
{

	function login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	function login_mhs($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	function login_user($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	function cek_dosen($nidn)
	{
		$this->db->select("*");
		$this->db->from("dosen");
		$this->db->where("nidn", $nidn);
		return $this->db->get()->row();
	}

	function cek_kaprodi($id_ptk)
	{
		$this->db->select("id_jur");
		$this->db->from("jurusan");
		$this->db->where("id_kaprodi", $id_ptk);
		return $this->db->get();
	}

	function cek_jabatan($id_ptk)
	{
		$this->db->select("*");
		$this->db->from("wastu_jabatan_struktural");
		$this->db->where("id_jabatan", $id_ptk);
		$jabatan = $this->db->get()->row();
		return $jabatan;
	}

	function get_one_user()
	{
		$query = $this->db->query("SELECT id_user
									FROM k__user
									WHERE nidn='" . $this->session->userdata('nidn') . "' AND username='" . $this->session->userdata('name') . "'");
		return $query;
	}
}
