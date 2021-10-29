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
        return $query;
      }else{
        return false;
      }

    }
}
?>