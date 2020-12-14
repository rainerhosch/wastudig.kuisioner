<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_catatan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // kueri

    function get_one($id_catatan){
        $param = array('id_catatan' => $id_catatan);
        return $this->db->get_where('k__catatan_kues',$param);
    }
    function update_action($data,$id_catatan){
        $this->db->where('id_catatan',$id_catatan);
        $this->db->update('k__catatan_kues',$data);
    }
    
}