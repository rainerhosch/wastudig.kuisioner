<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_question extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    var $table = "k__master_pertanyaan";
    var $select_column= array('id_pertanyaan','k__master_pertanyaan.id_kompetensi','pertanyaan','id_tahun','k__kompetensi.kompetensi');
    /*var $order_column= array(null,'id_tahun','nilai_from','nilai_to','kategori', null);*/
    var $order_column= array(null,null,'pertanyaan','id_tahun','k__kompetensi.kompetensi', null); //null untuk index kolom ke 0 dan 2 di datatable
    var $search_column= array('pertanyaan','id_tahun','k__kompetensi.kompetensi');

    // kueri dan searching
    function buat_query(){ 
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->join('k__kompetensi', 'k__kompetensi.id_kompetensi = k__master_pertanyaan.id_kompetensi');
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
            $this->db->order_by("id_pertanyaan","DESC"); // DESC order
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

    function count_all()
    {
        $this->db->from('k__master_pertanyaan');
        return $this->db->count_all_results();
    }

    // get filtered data
    function get_filtered_data() //menghitung banyaknya filtered record yang dimiliki
    {
        $this->buat_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_data_ques_by_th($tahun) {
        $query="SELECT p.id_pertanyaan, k.kompetensi, p.id_kompetensi, p.pertanyaan, p.id_tahun
                FROM k__master_pertanyaan p
                JOIN k__kompetensi k ON p.id_kompetensi=k.id_kompetensi
                WHERE p.id_tahun=".$tahun." GROUP BY p.id_kompetensi";
        return $this->db->query($query);
    }

    function get_ques_by_th($tahun) {
        $query="SELECT p.id_pertanyaan, k.kompetensi, p.id_kompetensi, p.pertanyaan, p.id_tahun
                FROM k__master_pertanyaan p
                JOIN k__kompetensi k ON p.id_kompetensi=k.id_kompetensi
                WHERE p.id_tahun=".$tahun."";
        return $this->db->query($query);
    }


    function get_one($id_pertanyaan){
        $param = array('id_pertanyaan' => $id_pertanyaan);
        return $this->db->get_where('k__master_pertanyaan',$param);
    }

    function input_action($data){
        $this->db->insert('k__master_pertanyaan', $data);
    }

    function update_action($data,$id_pertanyaan){
        $this->db->where('id_pertanyaan',$id_pertanyaan);
        $this->db->update('k__master_pertanyaan',$data);
    }

    function delete_action($id_pertanyaan){
        $this->db->where('id_pertanyaan',$id_pertanyaan);
        $this->db->delete('k__master_pertanyaan');
    }

}