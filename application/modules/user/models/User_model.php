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
      $this->db->or_where('iPhoneNumber',$user['vEmail']);
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
  //fetch detail for forget password
  public function forgetpassword($iPhoneNumber){
      $this->db->select('*');
      $this->db->from('vnr_user'); 
      $this->db->where('iPhoneNumber', $iPhoneNumber); 
      $query = $this->db->get();
      if($query->num_rows() >0){
      return $query->row_array();
      }else{
        return false;
      }
  }
  //otp generation
  public function generateNumericOTP($n) {  
    $generator = "135792468"; 
    $result = ""; 
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    }  
    return $result; 
  }
  //save otp to Database
  public function otp_generate($number,$data){
    $this->db->where('iPhoneNumber', $number); 
    $this->db->update('vnr_user',$data);
  }
  // otp verify
  public function check_otp($iOtpCode,$id){
    $this->db->select('*');
    $this->db->from('vnr_user'); 
    $this->db->where('iOtpCode',$iOtpCode);
    $this->db->where('iUserId',$id);
    $query = $this->db->get();
    if($query->num_rows() >0){
    return $query->row_array();
    }else{
      return false;
    }
  }
  function update_password($id,$data){
    $this->db->where('iUserId', $id); 
    $this->db->update('vnr_user',$data); 
      
  }
}
?>