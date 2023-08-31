<?php

class M_profile extends CI_Model{
    public function insert($data){
        $this->db->insert('p_contact_us',$data);
    }
}