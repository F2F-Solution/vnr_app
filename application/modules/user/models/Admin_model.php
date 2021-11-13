<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_model{
    public function __construct()
    {
        $this->load->database();
    }
   
    public function select($id)  
    {  
       //data is retrive from this query 
       $this->db->select('*');
       $this->db->where('iUserId',$id);
       $query = $this->db->get('vnr_user')->result_array();  
       return $query;  
       
    }  
   // update data
    public function update_data($data,$iUserId){
        $this->db->where('iUserId', $iUserId);
        $this->db->update('vnr_user',$data);
    // print_r($this->db->last_query());exit;
    }
}
?>