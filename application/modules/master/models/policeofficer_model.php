<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class policeofficer_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
    //fetch data for dropdown list
    public function getalldesignation(){
        $data = array();
        $active = 1;
        $data['designation_name'] = $this->db->query("SELECT * FROM vnr_police_designation where tStatus = $active")->result();
        $data['department_name'] = $this->db->query("SELECT *  FROM vnr_police_department where tStatus = $active")->result();
        $data['group_name'] = $this->db->query("SELECT * FROM vnr_police_group where tStatus = $active")->result();
        return $data;
    }
    public function store($user){
        $this->db->insert('vnr_police_officer',$user);
    }
 }