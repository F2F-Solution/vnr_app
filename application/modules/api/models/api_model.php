<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_model extends CI_Model {

    private $customer = 'vnr_customer';

    function __construct() {
        parent::__construct();
    }

    function insert_customer_details($data) {
        $data['vPassword'] = md5($data['vPassword']);
        if ($this->db->insert('customer', $data)) {
            $customer_id = $this->db->insert_id();
            return $customer_id;
        }
        return FALSE;
    }

    function is_mobile_number_exists($mobile_number) {
        $this->db->where('tab_1.iMobileNumber', $mobile_number);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get($this->customer . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function is_email_id_exists($email_id) {
        $this->db->where('tab_1.vEmail', $email_id);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get($this->customer . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // function get_customer_details_by_insert_id($customer_id) {
    //     $this->db->select('tab_1.*');
    //     $this->db->where('tab_1.iCustomerId', $customer_id);
    //     $query = $this->db->get($this->customer . ' AS tab_1');
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     }
    //     return NULL;
    // }

    // public function get_customer_by_login($mobile_number, $password) {
    //     $this->db->select('tab_1.*');
    //     $this->db->where('tab_1.iMobileNumber', $mobile_number);
    //     $this->db->where('tab_1.vPassword', md5($password));
    //     $this->db->where('tab_1.tStatus', 1);
    //     $query = $this->db->get($this->customer . ' AS tab_1');
    //     if ($query->num_rows() >= 1) {
    //         return $query->result_array();
    //     }
    //     return false;
    // }


    // function insert_complaint_details($data) {
    //     if ($this->db->insert('file_complaint', $data)) {
    //         $complaint_id = $this->db->insert_id();
    //         return $complaint_id;
    //     }
    //     return FALSE;
    // }

    // function get_complaint_details_by_insert_id($complaint_id) {
    //     $this->db->select('tab_1.*');
    //     $this->db->where('tab_1.iFileComplaintId', $complaint_id);
    //     $query = $this->db->get('file_complaint' . ' AS tab_1');
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     }
    //     return NULL;
    // }
    
    // function get_locked_home_details($data){
    //     if($this->db->insert('locked_home', $data)){
    //     $locked_home_id=$this->db->insert_id();
    //     return $locked_home_id;
    //     }
    //     return FALSE; 
    // }
    
    // function get_locked_home_details_by_insert_id($locked_home_id){
    //     $this->db->select('tab_1.*');
    //     $this->db->where('tab_1.iLockedHomeId',$locked_home_id);
    //     $query = $this->db->get('locked_home' . 'AS tab_1');
    //     if($query->num_rows() > 0){
    //         return result_array();
    //     }
    //     return NULL;
    // }
}