<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('api_model');
	}

	function customer_register() {
		$data_input = $this->_get_customer_post_values();
		if (!empty($data_input)) {
			$customer = array();
			$customer['vCustomerName'] = $data_input['consumer_name'];
			$customer['vEmail'] = $data_input['email_id'];
			$customer['dDob'] = $data_input['dob'];
			$customer['iMobileNumber'] = $data_input['mobile_number'];
			$customer['vPassword'] = $data_input['password'];
			$customer['vAddress'] = $data_input['address'];
			$customer['iAadharNo'] = $data_input['aadhar_number'];
			$customer['iPincode'] = $data_input['pincode'];
			$customer['vProfession'] = $data_input['profession'];
			// $customer['vEmergencyName'] = $data_input['emergency_name'];
			// $customer['iEmergencyNumber'] = $data_input['emergency_number'];
			$customer['tCreatedAt'] = date('Y-m-d h:i:s');
			$customer['tStatus'] = 1;
			$otp = $this->api_model->generateNumericOTP('4');
			$customer['iOtpCode'] = $otp;
			if($customer['vCustomerName'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Name is required");
					
					$this->response($output);
				exit;
			}
			if($customer['iMobileNumber'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Mobile number is required");
					$this->response($output);
				exit;
			}
			if($customer['vEmail'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Email is required");
					$this->response($output);
				exit;
			}
			if($customer['iAadharNo'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Aadhar number is required");
					$this->response($output);
				exit;
			}
			if($customer['vPassword'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Password is required");
					$this->response($output);
				exit;
			}
			if($customer['vAddress'] == ""){
			    $output = array(
			        'status' => 'false',
			        'code' => '422',
			        'message' => "Address is required");
					$this->response($output);
			    exit;
			}
			if($customer['iPincode'] == ""){
			    $output = array(
			        'status' => 'false',
			        'code' => '422',
			        'message' => "Pincode number is required");
					$this->response($output);
			    exit;
			}
			$is_mobile_number_exists = $this->api_model->is_mobile_number_exists($customer['iMobileNumber']);
			if ($is_mobile_number_exists) {
				$output = array(
					'status' => 'false',
					'message' => "The given mobile number already exists.");
					$this->response($output);
				exit;
			}

			$is_aadhar_exists = $this->api_model->is_aadhar_exists($customer['iAadharNo']);
			if ($is_aadhar_exists) {
				$output = array(
					'status' => 'false',
					'message' => "The given Aadhar number already exists.");
					$this->response($output);
				exit;
			}

			$is_email_id_exists = $this->api_model->is_email_id_exists($customer['vEmail']);
			if ($is_email_id_exists) {
				$output = array(
					'status' => 'false',
					'message' => "The given email already exists.");
					$this->response($output);
				exit;
			}
			
			$insert = $this->api_model->insert_customer_details($customer);
			if (!empty($insert) && $insert != 0) {
				$customer_details = $this->api_model->get_customer_details_by_insert_id($insert);
				$this->response([
					'status' => "Success",
					'code'=>"200",
					'message' => 'The customer has been registered successfully.',
					'customer_data' => $customer_details
				]);
			}
		} else {
		$output = array(
			"status" => "false",
			"code"=> "422",
			"message" => "Provide complete customer information to add.");
			$this->response($output);
		}
	}

	public function customer_login(){
        $data = $this->_get_customer_post_values();
        if (!empty($data)) {
                $login_result = $this->api_model->check_login_details($data);
				// print($login_result);exit;
                if ($login_result) {
                    if($login_result == 1){
                        $output = array ('status' => 'Error', 'message' => 'OTP not verified');
                        echo json_encode($output);
                    }else{
                        $output = array ('status' => 'Success', 'message' => 'Login successfully','data'=>$login_result);
                        echo json_encode($output);
                    }
                   
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Invalid login credentials');
                    echo json_encode($output);
                }
        } else {
            $output = array ('status' => 'error', 'message' => 'Please mobile number and password');
            echo json_encode($output);
        }
    }

	public function check_customer_otp(){
		$json_input = $this->_get_customer_post_values();
        if (!empty($json_input)) {
                $otp_result = $this->api_model->check_customer_otp($json_input);
                if (!empty($otp_result) && $otp_result['iOtpCode'] == $json_input['otp_code']) {
                    $update_data['tOtpVerify']=1;
                    $this->api_model->update_fields($otp_result['iCustomerId'],$update_data);
                    $output = array ('status' => 'Success', 'message' => 'Otp Verified successfully','data'=>$otp_result);
                    $this->response($output);
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Invalid OTP');
                    $this->response($output);
                }
        } else {
            $output = array ('status' => 'error', 'message' => 'Please enter valid details');
			$this->response($output);
        }
    }

	public function customer_resend_otp(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$otp = $this->api_model->generateNumericOTP('4');
			$update_data['iOtpCode'] = $otp;
			$update = $this->api_model->update_fields($json_input['customer_id'],$update_data);
			$output = array('status' => 'Success', 'message' => 'Otp send successfully');
			$this->response($output);

		}else
		{
			$output = array ('status' => 'Error', 'message' => 'User not found');
            $this->response($output);
		}

		
	}

	public function get_locked_home_details(){
		$data_input = $this->_get_customer_post_values();
		// print_r($data_input);exit;
		if (!empty($data_input)) {
			$customer = array();
			$customer['iCustomerId'] = $data_input['customer_id'];
			$customer['dFromDate'] = $data_input['startdate'];
			$customer['dToDate'] = $data_input['Enddate'];
			$customer['iPincode'] = $data_input['pincode'];
			$customer['iIdProofNumber'] = $data_input['identification_number'];
			$customer['vIdProoftype'] = $data_input['identification_number_type'];
			$customer['vAttachment'] = $data_input['attachments'];
			$customer['tStatus'] = 1;

			$otp = $this->api_model->generateNumericOTP('4');
			// $customer['iOtpCode'] = $otp;
			if($customer['dFromDate'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Start date is required");
					
					$this->response($output);
				exit;
			}
			if($customer['dToDate'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "End date is required");
					$this->response($output);
				exit;
			}
			if($customer['iPincode'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Pincode is required");
					$this->response($output);
				exit;
			}
			if($customer['vIdProoftype'] == ""){
			    $output = array(
			        'status' => 'false',
			        'code' => '422',
			        'message' => "Id Prooftype is required");
					$this->response($output);
			    exit;
			}
			if($customer['iIdProofNumber'] == ""){
			    $output = array(
			        'status' => 'false',
			        'code' => '422',
			        'message' => "Id ProofNumber is required");
					$this->response($output);
			    exit;
			}
			
			
			$insert = $this->api_model->get_locked_home_details($customer);
			if (!empty($insert) && $insert != 0) {
				$home_details = $this->api_model->get_lockedhome_details_by_insert_id($insert);
				$this->response([
					'status' => "Success",
					'code'=>"200",
					'message' => 'The details has been registered successfully.',
					'customer_data' => $home_details
				]);
			}
		} else {
		$output = array(
			"status" => "false",
			"code"=> "422",
			"message" => "Provide complete customer information to add.");
			$this->response($output);
		}
	}

	public function api_profile_details(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$user_details = $this->api_model->get_customer_details($json_input);
			if($user_details){
				$output = array(
				"status" => "Success",
				"code"=> "200",
				"message" => "Customer profile details",
				"data" => $user_details,
				);
				$this->response($output);
			}else {
				$output = array (
					'status' => 'Error', 
					'message' => 'Profile details not found'
				);
				$this->response($output);
			}
		}else{
		$output = array(
			"status" => "false",
			"code"=> "422",
			"message" => "Please provide valid details");
			$this->response($output);
		}
	}

	// public function update_profile_details(){
	// 	$json_input = $this->_get_customer_post_values();
	// 	if(!empty($json_input)){
	// 		$customer['vName'] = $data_input['consumer_name'];
	// 		$customer['vEmail'] = $data_input['email_id'];
	// 		$customer['dDob'] = $data_input['dob'];
	// 		$customer['iMobileNumber'] = $data_input['mobile_number'];
	// 		$customer['vPassword'] = $data_input['password'];
	// 		$customer['vAddress'] = $data_input['address'];
	// 		$customer['iPincode'] = $data_input['pincode'];
	// 		$check_duplicate_email = $this->api_model->check_field_exists('vEmail',$data_input['email_id'],$data_input['customer_id']);
			

	// 	}
	// }

	public function customer_logout(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$logout = $this->api_model->get_customer_details($json_input['customer_id']);
			if($logout){
				$output = array(
					'code'=> '200',
					'type'=> 'Success',
					'message' => 'Customer Logged Out Successfully.',
				);
				$this->response($output);
			}else{
				$output = array(
					'code'=> '402',
					'type'=> 'Error',
					'message' => 'User not found',
				);
				$this->response($output);
			}
		}else{
			$output = array(
				'code'=> '402',
				'type'=> 'Error',
				'message' => 'Provide required information',
			);
			$this->response($output);
		}

	}

	public function generate_otp(){
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$customer = $this->api_model->forgot_password($json_input);
			if($customer){
				$otp = $this->api_model->generateNumericOTP('4');
				$update_data['iOtpCode'] = $otp;
				$this->api_model->update_fields($customer['iCustomerId'],$update_data);
				$details = $this->api_model->get_customer_details($customer['iCustomerId']	);
				$output = array(
					'status' => 'success', 'code' =>200 ,'message' => 'OTP sent successfully','data'=> $details
				);
				$this->response($output);
			}else{
				$output = array(
					'status' => 'error', 'code'=>415 , 'message' => 'Invalid credentials'
				);
			}
        } else {
            $output = array ('status' => 'error', 'message' => 'Please enter input data');
            echo json_encode($output);
        }
    }
		
	public function get_police_station_details(){
		$police_station = $this->api_model->police_station_details();
		if($police_station){
			$output = array(
				'code'=> '200',
				'type'=> 'Success',
				'message' => 'Police station list.',
				'data' => $police_station,
			);
			$this->response($output);
		}else{
			$output = array (
				'status' => 'Error', 
				'message' => 'police station details not found'
			);
			$this->response($output);
		}
	}

	public function get_police_officers(){
		$police_officers = $this->api_model->police_officers_details();
		if($police_officers){
			$output = array(
				'code'=> '200',
				'type'=> 'Success',
				'message' => 'Police officers list.',
				'data' => $police_officers,
			);
			$this->response($output);
		}else{
			$output = array (
				'status' => 'Error', 
				'message' => 'police officers details not found'
			);
			$this->response($output);
		}
	}

	public function get_ads_list(){
		$ads = $this->api_model->get_ads();
		if($ads){
			$output = array(
				'status'=> 'Success',
				'message'=>'Ads list',
				'data' => $ads
			);
			$this->response($output);
		}else{
			$output = array (
				'status' => 'Error', 
				'message' => 'Ads not found'
			);
			$this->response($output);
		}
	}
}
