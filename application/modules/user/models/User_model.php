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
}
?>