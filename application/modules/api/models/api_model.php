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
                $update['tLoginStatus'] = 1;
                $this->db->update('vnr_customer',$update,array('iCustomerId'=>$query['iCustomerId']));
                $this->db->select('*');
                $this->db->where('iCustomerId',$query['iCustomerId']);
                $this->db->from('vnr_customer');
                $result = $this->db->get()->result_array();
                return $result;
            }else{
                $this->db->where('iCustomerId',$query['iCustomerId']);
                $this->db->delete('vnr_customer');
                return 1;
            }
        }
        return false;
    }

    public function check_customer_otp($data){
        $this->db->select('*');
        $this->db->where('iCustomerId',$data);
        $query = $this->db->get('vnr_customer')->row_array();
        if(!empty($query)){
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
            $this->db->where('iCustomerId !=',$id);
        $result = $this->db->get('vnr_customer')->row_array();
        if(!empty($result)){
            if($result['otp_verify'] == 0){
                // $this->db->where('id',$result['id']);
                // $this->db->delete($this->customers);
                return false;
            }else{
                return $result;
            }
        }
        return false;
    }

    public function forgot_password($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $this->db->where('iAadharNo',$data['aadhar_number']);
        $this->db->from('vnr_customer');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else
        return false;

    }

    public function get_customer_details($data){
        $this->db->select('*');
        $this->db->where('iCustomerId',$data);
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
            $id = $this->db->insert_id();
            return $id;
        }
        return FALSE;    
        
    }

    public function get_lockedhome_details_by_insert_id($data){
        $base_url = base_url().'uploads/';
        $this->db->select('iLockedHomeId,iCustomerId,dFromDate,dToDate,vCustomerName,iPhoneNumber,vAddress,iPincode,vCustomerLocation,vLatitude,vLongitude,CONCAT("'.$base_url.'",vAttachment) AS vAttachment,iIdProofNumber,vIdProoftype,tStatus,tcreatedAt',FALSE);
        // $this->db->select('tab_1.*');
        $this->db->where('iLockedHomeId', $data);
        $this->db->from('vnr_locked_home');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return NULL;
    }

    public function get_customer_profile_details($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $data =  $this->db->get('vnr_customer')->row_array();

        return $data;
    }

    /*public function police_station_details(){
        $this->db->select('station.*,officer.*,department.vDepartmentName,group.vGroupName,designation.vDesignationName');
        $this->db->from('vnr_police_officer as officer');
        $this->db->join('vnr_police_station as station','station.iPoliceStationId = officer.iPoliceOfficerId','left');
        $this->db->join('vnr_police_designation as designation','designation.iDesignationId = officer.iDesignationId','left');
        $this->db->join('vnr_police_department as department','department.iDepartmentId = officer.iDepartmentId','left');
        $this->db->join('vnr_police_group as group','group.iGroupid=officer.iGroupid','left');
        $query = $this->db->get();
        return $this->db->last_query();
        if($query->num_rows() >0){
        return $query->result_array();
        }else{
            return false;
        }
    }*/
    public function police_station_details(){ 
        $this->db->select('station.*,department.vDepartmentName,group.vGroupName,designation.vDesignationName,officer.*');
        $this->db->join('vnr_police_officer as officer', 'officer.iPoliceStationId = station.iPoliceStationId','left');
        $this->db->join('vnr_police_designation as designation','designation.iDesignationId = officer.iDesignationId','left');
        $this->db->join('vnr_police_department as department','department.iDepartmentId = officer.iDepartmentId','left');
        $this->db->join('vnr_police_group as group','group.iGroupid=officer.iGroupid','left');
        $query = $this->db->get('vnr_police_station as station');
        if($query->num_rows() >0){
        return $query->result_array();
        }else
            return false;
    }

    public function police_officers_details(){
        $this->db->select('officer.iPoliceOfficerId,officer.vOfficerName,officer.iMobileNumber,officer.iEmail,officer.vGender,station.vStationName,station.vPrimaryAttender,station.iEmergencyNO,station.iPoliceStationNumber,station.iStationLandNo,station.vEmail,station.vAddress,station.iPincode,station.iLocation,department.vDepartmentName,group.vGroupName,designation.vDesignationName');
        $this->db->from('vnr_police_officer as officer');
        $this->db->join('vnr_police_station as station','officer.iPoliceStationId=station.iPoliceStationId','left');
        $this->db->join('vnr_police_designation as designation','officer.iDesignationId=designation.iDesignationId','left');
        $this->db->join('vnr_police_department as department','officer.iDepartmentId=department.iDepartmentId','left');
        $this->db->join('vnr_police_group as group','group.iGroupid=officer.iGroupid','left');
        $query = $this->db->get();
        if($query->num_rows() >0){
        return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_ads(){
        $base_url = base_url().'uploads/';
        $this->db->select("iAdtype,vAdContent,CONCAT('".$base_url."',vAdImage) AS image,tAdStatus", FALSE);
        $this->db->from('vnr_manage_ads');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_news(){
        $base_url = base_url().'uploads/';
        $this->db->select('inewsid,vNewsSubject,vNewsMessage,CONCAT("'.$base_url.'",vNewsImage) AS vNewsImage,tNewsStatus,tCreatedAt');
        $this->db->from('vnr_news');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    // public function update_locked_home($id,$data){
    //     $data['tUpdatedAt']=date('Y-m-d h:i:s');
    //     $this->db->where('iLockedHomeId',$id);
    //     $this->db->update('vnr_locked_home',$data);
    //     return true;
    // }

    public function get_terms_and_conditions(){
        $this->db->select('*');
        $this->db->from('vnr_terms_and_conditions');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else
        return false;
    }

    public function get_notification($data){
        if($this->db->insert('vnr_notifications',$data)){
            $insertid = $this->db->insert_id();
            $this->db->select('*');
            $this->db->where('iNotificationId',$insertid);
            $this->db->from('vnr_notifications');
            $query = $this->db->get()->row_array();
            return $query;
        }else
        return false;
    }

    public function user_notification($data){
        $this->db->select('*');
        $this->db->where('iCustomerId',$data);
        $this->db->from('vnr_notifications');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else
        return false;
    }

    public function check_employee_login($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $this->db->where('vPassword',(md5($data['password'])));
        // $this->db->where('tStatus',1);
        $this->db->from('vnr_police_officer');
        $query = $this->db->get();
        if($query->num_rows() >0){
        return $query->row_array();            
        }
        return false;
    }

    public function update_lockedhome($column,$data,$update){
        $this->db->where($column ,$data);
        if($this->db->update('vnr_locked_home',$update)){
            return true;
        }else
        return false;
    }

    public function check_employee_mail($email,$id){
        $this->db->select('*');
        $this->db->where('iEmail',$email);
        if($id != '')
        $this->db->where('iPoliceOfficerId !=',$id);
        $result = $this->db->get('vnr_police_officer');
        if($result->num_rows() >0){
            return $result;
        }
        else{
            return false;
        }
    }

    
    public function get_employee_details($id){
        $this->db->select('*');
        $this->db->where('iPoliceOfficerId',$id);
        $this->db->from('vnr_police_officer');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else
        return false;
    }

    public function get_home_details(){
        $base_url = base_url().'uploads/';
        $this->db->select('iLockedHomeId,iCustomerId,dFromDate,dToDate,vCustomerName,iPhoneNumber,vAddress,iPincode,vCustomerLocation,vLatitude,vLongitude,CONCAT("'.$base_url.'",vAttachment) AS vAttachment,iIdProofNumber,vIdProoftype,tStatus,tcreatedAt',FALSE);
        $this->db->from('vnr_locked_home');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else
        return false;
    }

    public function get_police_officer($data){
        $data['vPassword'] = md5($data['vPassword']);
        if ($this->db->insert('vnr_police_officer', $data)) {
            $employee_id = $this->db->insert_id();
            return $employee_id;
        }
        return FALSE;
    }

    public function get_police_officer_by_insert_id($data){
        $this->db->select('officer.*,station.*');
        $this->db->where('iPoliceOfficerId',$data);
        $this->db->join('vnr_police_station as station','station.iPoliceStationId=officer.iPoliceStationId','left');
        $query = $this->db->get('vnr_police_officer as officer');
        if($query->num_rows() >0){
        return $query->result_array();
        }else{
        return false;
        }
    }

    function is_employee_number_exists($mobile_number) {
        $this->db->where('tab_1.iMobileNumber', $mobile_number);
        // $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_police_officer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_employee_email_exists($email_id) {
        $this->db->where('tab_1.iEmail', $email_id);
        // $this->db->where('tab_1.tStatus', 1);
        $query = $this->db->get('vnr_police_officer' . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_employee_login_details($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $this->db->where('vPassword',(md5($data['password'])));
        // $this->db->where('tStatus',1);
        $this->db->from('vnr_police_officer');
        $query = $this->db->get()->row_array();
        $result=array();
        if(!empty($query)){
            if($query['tOtpVerify'] == 1){
                // $update['tLoginStatus'] = 1;
                // $this->db->update('vnr_customer',$update,array('iCustomerId'=>$query['iCustomerId']));
                $this->db->select('*');
                $this->db->where('iPoliceOfficerId',$query['iPoliceOfficerId']);
                $this->db->from('vnr_police_officer');
                $result = $this->db->get()->row_array();
                return $result;
            }else{
                $this->db->where('iPoliceOfficerId',$query['iPoliceOfficerId']);
                $this->db->delete('vnr_police_officer');
                return 1;
            }
        }
        return false;
    }

    public function update_officer_details($column,$data,$update){
        $this->db->where($column,$data);
        $this->db->update('vnr_police_officer',$update);
        return true;
    }

    public function employee_forgot_password($data){
        $this->db->select('*');
        $this->db->where('iMobileNumber',$data['mobile_number']);
        $this->db->from('vnr_police_officer');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->row_array();
        }else
        return false;

    }

    public function get_station_list(){
        $this->db->select('station.*,officer.vOfficerName as primary_attender');
        $this->db->from('vnr_police_station as station');
        $this->db->join('vnr_police_officer as officer','officer.iPoliceOfficerId=station.vPrimaryAttender','left');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else
        return false;
    }

    public function check_employee_exists($column,$data,$id){
        $this->db->select('*');
        $this->db->where($column,$data);
        // $this->db->where('tStatus',1);
        if($id != '')
            $this->db->where('iPoliceOfficerId !=',$id);
        $result = $this->db->get('vnr_police_officer')->row_array();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    public function update_employee($data,$id){
        $this->db->where('iPoliceOfficerId',$id);
        if($this->db->update('vnr_police_officer',$data)){
            return true;
        }else{
            return false;
        }
    }

    public function get_custom_employee_details($data){
        $this->db->select('officer.*,station.vAddress,station.iPincode,station.vStationName,designation.vDesignationName,department.vDepartmentName');
        $this->db->where('iPoliceOfficerId',$data);
        $this->db->from('vnr_police_officer as officer');
        $this->db->join('vnr_police_designation as designation','designation.iDesignationId = officer.iDesignationId','left');
        $this->db->join('vnr_police_department as department','department.iDepartmentId = officer.iDepartmentId','left');
        $this->db->join('vnr_police_station as station','station.iPoliceStationId = officer.iPoliceStationId','left');
        $query = $this->db->get();
        if($query->num_rows() >0){
        return $query->result_array();
        }else{
        return false;
        }
    }

    public function get_department(){
        $this->db->select('*');
        $this->db->from('vnr_police_department');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else
        return false;

    }

    public function get_designation(){
        $this->db->select('*');
        $this->db->from('vnr_police_designation');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else
        return false;
    }

    public function get_lockedhome_history($data){
        $this->db->insert('vnr_locked_home_history',$data);
    }

    public function get_all_lockedhome_history($data){
        $this->db->select('history.*,officer.vOfficerName');
        $this->db->where('history.iCustomerId',$data);
        $this->db->from('vnr_locked_home_history as history');
        $this->db->join('vnr_police_officer as officer','officer.iPoliceOfficerId=history.iPoliceOfficerId','left');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_all_lockedhome_history_by_officer($officerid,$lockedhomeid){
        $this->db->select('history.*,officer.vOfficerName,customer.vCustomerName');
        $this->db->where('history.iPoliceOfficerId',$officerid);
        $this->db->where('history.iLockedHomeId',$lockedhomeid);
        $this->db->from('vnr_locked_home_history as history');
        $this->db->join('vnr_police_officer as officer','officer.iPoliceOfficerId=history.iPoliceOfficerId','left');
        $this->db->join('vnr_customer as customer','customer.iCustomerId=history.iCustomerId ','left');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_all_lockedhome_history_by_customer($customerId,$lockedhomeid){
        $this->db->select('history.*,officer.vOfficerName,customer.vCustomerName');
        $this->db->where('history.iCustomerId',$customerId);
        $this->db->where('history.iLockedHomeId',$lockedhomeid);
        $this->db->from('vnr_locked_home_history as history');
        $this->db->join('vnr_police_officer as officer','officer.iPoliceOfficerId=history.iPoliceOfficerId','left');
        $this->db->join('vnr_customer as customer','customer.iCustomerId=history.iCustomerId ','left');
        $query = $this->db->get();
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function update_police_station($id,$update){
        $this->db->where('iPoliceStationId',$id);
        $this->db->update('vnr_police_station',$update);
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
    

}