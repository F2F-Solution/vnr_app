<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class group_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
    //store data into DB
    public function store($user){
        $this->db->insert('vnr_police_group',$user);
    }
    //list into table
    public function select(){
        $query = $this->db->get('vnr_police_group');  
        return $query;  
    }
    //edit data
    public function find_data($iGroupid){
        $this->db->where('iGroupid', $iGroupid);
        $query = $this->db->get('vnr_police_group');
        return $query->row_array();
    }
    //update data
    public function update_data($data,$iGroupid){
        $this->db->where('iGroupid', $iGroupid);
        $this->db->update('vnr_police_group',$data);
    }
    //Delete data
    public function delete_data($iGroupid){
        $this->db->where('iGroupid', $iGroupid);
        $this-> db->delete('vnr_police_group');
    }
    
}