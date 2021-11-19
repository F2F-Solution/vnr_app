<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_model{
    public function __construct()
    {
        $this->load->database();
    }
    //insert data to database
    public function register_user($user){
        $this->db->insert('vnr_user',$user);
    }
    // verify login details
    public function verify($user){
      $this->db->select('*');
      $this->db->where('vEmail',$user['vEmail']);
      $this->db->where('vPassword',md5($user['vPassword']));
      $this->db->where('tStatus',1);
      $query = $this->db->get('vnr_user');
      if($query->num_rows() >0){
        return $query->row_array();
      }else{
        return false;
      }
    }
    //filter data 
    public function getcount_lockedhome(){
      $this->db->select('*');
      $query = $this->db->get('vnr_locked_home');
      return $query->row_array();
    }
    public function getcount_policeofficer(){
      $this->db->select('*');
      $query = $this->db->get('vnr_police_officer');
      return $query->row_array();
    }
    public function getcount_policestation(){
      $this->db->select('*');
      $query = $this->db->get('vnr_police_station');
      return $query->row_array();
    }
    public function getcount_unvisited_home(){
      $this->db->select('*');
      $this->db->where('tStatus',3);
      $query = $this->db->get('vnr_locked_home');
      return $query->result();
    }
    // get data from terms and condition
    public function getlist_terms(){
      $this->db->select('*');
      $query = $this->db->get('vnr_terms_and_conditions');
      return $query->result();
     }  
    //  edit data
     public function find_data($iTermsandConditionsId){
      $this->db->where('iTermsandConditionsId', $iTermsandConditionsId);
      $query = $this->db->get('vnr_terms_and_conditions');
      return $query->row_array();
     }
   //update data
    public function update_data($data,$iTermsandConditionsId){
        $this->db->where('iTermsandConditionsId', $iTermsandConditionsId);
        $this->db->update('vnr_terms_and_conditions',$data);
        // print_r($this->db->last_query());exit;
     }

    //Delete data
    public function delete_data($iTermsandConditionsId){
      $this->db->where('iTermsandConditionsId', $iTermsandConditionsId);
      $this-> db->delete('vnr_terms_and_conditions');
  }
  public function forgetpassword($iPhoneNumber){
      $this->db->select('iPhoneNumber');
      $this->db->from('vnr_user'); 
      $this->db->where('iPhoneNumber', $iPhoneNumber); 
      $query=$this->db->get();
      return $query->row_array();
    echo "<pre>" ;print_r($query);exit;
  }
}
 
?>