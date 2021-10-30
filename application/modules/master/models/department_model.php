<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class department_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
    //store data into DB
    public function store($user){
        $this->db->insert('vnr_police_department',$user);
    }
    //list into table
    public function select(){
        $query = $this->db->get('vnr_police_department');  
        return $query;  
    }
    //edit data
    public function find_data($iDepartmentId){
        $this->db->where('iDepartmentId', $iDepartmentId);
        $query = $this->db->get('vnr_police_department');
        return $query->row_array();
    }
    //update data
    public function update_data($data,$iDepartmentId){
        $this->db->where('iDepartmentId', $iDepartmentId);
        $this->db->update('vnr_police_department',$data);
    }
    //Delete data
    public function delete_data($iDepartmentId){
        $this->db->where('iDepartmentId', $iDepartmentId);
        $this-> db->delete('vnr_police_department');
    }
}