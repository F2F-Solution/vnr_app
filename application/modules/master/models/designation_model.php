<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class designation_model extends CI_model{
    public function __construct()
    {
        $this->load->database();
    }
    public function store($user){
        $this->db->insert('vnr_police_designation',$user);
    }
    public function select(){
        $query = $this->db->get('vnr_police_designation');  
        return $query;  
    }
}