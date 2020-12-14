<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pilihan extends CI_Model
{

    var $table = "k__pilihan";
    var $select_column = array('ID_pilih', 'id_tahun', 'pilihan1', 'pilihan2', 'pilihan3', 'pilihan4', 'pilihan5', 'pilihan6', 'pilihan7', 'pilihan8', 'pilihan9', 'pilihan10');
    var $order_column = array(null, 'id_tahun', null, null); //null untuk index kolom ke 0 dan 2 di datatable

    function __construct()
    {
        parent::__construct();
    }

    // kueri dan searching
    function buat_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"]))   // kueri pecarian
        {
            $this->db->like("id_tahun", $_POST["search"]["value"]); //id_tahun disini adalah nama kolom
        }
        if (isset($_POST["order"]))     //proses kolom order
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("ID_pilih", "DESC"); // DESC order
        }
    }

    // buat datatable
    function buat_datatable()
    {
        $this->buat_query();
        if ($_POST["length"] != -1)  // selama panjang record tidak sama dengan -1
        {
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }

    // get filtered data
    function get_filtered_data() //menghitung banyaknya filtered record yang dimiliki
    {
        $this->buat_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    // get semua data
    function get_all_data($q = NULL)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results(); //menghitung banyaknya semua record yang ada di tabel kompetensi
    }

    function get_pilihan_by_th($tahun)
    {
        $query = "SELECT ID_pilih,id_tahun,pilihan1,pilihan2,pilihan3,pilihan4,pilihan5,pilihan6,pilihan7,pilihan8,pilihan9,pilihan10
                FROM k__pilihan
                WHERE id_tahun=" . $tahun . "";
        return $this->db->query($query);
    }

    // mengambil satu data
    function fetch_single_data($id_pilih)
    {
        $this->db->where("ID_pilih", $id_pilih);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // insert data
    function insert_action($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update_action($id_pilih, $data)
    {
        $this->db->where("ID_pilih", $id_pilih);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete_action($id_pilih)
    {
        $this->db->where("ID_pilih", $id_pilih);
        $this->db->delete($this->table);
    }
}
