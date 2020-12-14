<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kriteria extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    var $table = "k__kriteria_nilai";
    var $select_column= array('id_kriteria','id_tahun','nilai_from','nilai_to','kategori');
    /*var $order_column= array(null,'id_tahun','nilai_from','nilai_to','kategori', null);*/
    var $order_column= array(null,null,'id_tahun','nilai_from','nilai_to','kategori', null); //null untuk index kolom ke 0 dan 2 di datatable
    var $search_column= array('id_tahun','nilai_from','nilai_to','kategori');

    // kueri dan searching
    function buat_query(){ 
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->search_column as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->search_column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $search_column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        if(isset($_POST["order"]))     //proses kolom order
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by("id_kriteria","DESC"); // DESC order
        }
    }

    // buat datatable
    function buat_datatable()
    {
        $this->buat_query();
        if($_POST["length"] != -1)  // selama panjang record tidak sama dengan -1
        {
            $this->db->limit($_POST["length"],$_POST["start"]);
        }
        $query = $this->db->get();
        return $query;
    }

    // kueri
    function get_kriteria() {
        $query=$this->db->select('*')->from('k__kriteria_nilai')->order_by('id_kriteria','DESC')->get();
        return $query;
    }

    // get filtered data
    function get_filtered_data() //menghitung banyaknya filtered record yang dimiliki
    {
        $this->buat_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_one($id_kriteria){
        $param = array('id_kriteria' => $id_kriteria);
        return $this->db->get_where('k__kriteria_nilai',$param);
    }

    function input_action($data){
        $this->db->insert('k__kriteria_nilai', $data);
    }

    function update_action($data,$id_kriteria){
        $this->db->where('id_kriteria',$id_kriteria);
        $this->db->update('k__kriteria_nilai',$data);
    }

    function delete_action($id_kriteria){
        $this->db->where('id_kriteria',$id_kriteria);
        $this->db->delete('k__kriteria_nilai');
    }

    function count_all()
    {
        $this->db->from('k__kriteria_nilai');
        return $this->db->count_all_results();
    }
    
}