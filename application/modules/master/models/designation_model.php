<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class designation_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
    //store data into DB
    public function store($user){
        $this->db->insert('vnr_police_designation',$user);
    }
    //list into table
    public function select(){
        $query = $this->db->get('vnr_police_designation');  
        return $query;  
    }
    //edit data
    public function find_data($iDesignationId){
        $this->db->where('iDesignationId', $iDesignationId);
        $query = $this->db->get('vnr_police_designation');
        return $query->row_array();
    }
    //update data
    public function update_data($data,$iDesignationId){
        $this->db->where('iDesignationId', $iDesignationId);
        $this->db->update('vnr_police_designation',$data);
    }
    //Delete data
    public function delete_data($iDesignationId){
        $this->db->where('iDesignationId', $iDesignationId);
        $this-> db->delete('vnr_police_designation');
    }
}