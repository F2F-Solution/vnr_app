<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_model extends CI_Model {


    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_customer_details($data) {
        $data['vPassword'] = md5($data['vPassword']);
        if ($this->db->insert('vnr_customer', $data)) {
            $customer_id = $this->db->insert_id();
            return $customer_id;
        }
        return FALSE;
    }

    function is_mobile_number_exists($mobile_number) {
        $this->db->where('tab_1.iMobileNumber', $mobile_number);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_aadhar_exists($aadhar) {
        $this->db->where('tab_1.iAadharNo', $aadhar);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function is_email_id_exists($email_id) {
        $this->db->where('tab_1.vEmail', $email_id);
        $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_customer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_customer_details_by_insert_id($customer_id) {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.iCustomerId', $customer_id);
        $query = $this->db->get('vnr_customer'. ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function generateNumericOTP($n) {  
        $generator = "135792468"; 
        $result = ""; 
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        }  
        return $result; 
    }

    public function check_login_details($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $this->db->where('vPassword',(md5($data['password'])));
        $this->db->where('tStatus',1);
        $this->db->from('vnr_customer');
        $query = $this->db->get()->row_array();
        $result=array();
        if(!empty($query)){
            if($query['tOtpVerify'] == 1){
                $result['customer_details']=$query;
                return $result;
            }else{
                return 1;
            }
        }
        return false;
    }

    public function check_customer_otp($data){
        $this->db->select('*');
        $this->db->where('iCustomerId',$data['customer_id']);
        $query = $this->db->get('vnr_customer')->row_array();
        if(!empty($query)){
            //$result['customer_id']=$query['id'];
            //$result['customer_details']=$query;
            //$result['settings'] = $this->getSettings();
            return $query;
        } 
        return false;
    }

    public function update_fields($id,$data){
        $data['iUpdatedAt']=date('Y-m-d h:i:s');
        $this->db->where('iCustomerId',$id);
        $this->db->update('vnr_customer',$data);
        return true;
    }

    public function check_field_exists($column,$email,$id){
        $this->db->select('*');
        $this->db->where($column,$email);
        $this->db->where('tStatus',1);
        if($id != '')
            $this->db->where('id !=',$id);
        $result = $this->db->get($this->customers)->row_array();
        if(!empty($result)){
            if($result['otp_verify'] == 0){
                $this->db->where('id',$result['id']);
                $this->db->delete($this->customers);
                return false;
            }else{
                return $result;
            }
        }
        return false;
    }

    public function get_customer_details($data){
        $this->db->select('*');
        $this->db->where('iCustomerId',$data['customer_id']);
        $this->db->from('vnr_customer');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function get_locked_home_details($data){
        if($this->db->insert('vnr_locked_home',$data)){
        // print_r($this->db->last_query());exit;
            $id = $this->db->insert_id();
            return $id;
        }
        return FALSE;    
        
    }

    public function get_lockedhome_details_by_insert_id($data){
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.id', $data);
        $query = $this->db->get('vnr_locked_home'. ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_customer_profile_details($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $data =  $this->db->get('vnr_customer')->row_array();

        return $data;
    }

    public function police_station_details(){
        $this->db->select('*');
        $this->db->from('vnr_police_station');
        $query = $this->db->get();
        if($query-num_rows() >0){
        return $query->row_array();
        }else{
            return false;
        }
    }

    public function police_officers_details(){
        $this->db->select('*');
        $this->db->from('vnr_police_officer');
        $query = $this->db->get();
        if($query-num_rows() >0){
        return $query->row_array();
        }else{
            return false;
        }
    }

    public function get_ads(){
        $this->db->select('*');
        $this->db->from('vnr_manage_ads');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else{
            return false;
        }
    }

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