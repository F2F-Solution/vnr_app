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

			//otp mail sending
			$msg = 'Your Otp code is '.$otp.' - VNR app';
			$sub = 'Registration Otp';


			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.googlemail.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = 'ftwoftesting@gmail.com';
			$config['smtp_pass']    = 'MotivationS@1';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'text';
			$config['validation'] = TRUE; // bool whether to validate email or not      
			$this->load->library('email',$config);

			$this->email->initialize($config);

			$this->email->from('ftwoftesting@gmail.com','Tester');
			$this->email->to($customer['vEmail']); 
			$this->email->subject($sub);
			$this->email->message($msg);  

			$this->email->send();
			// if($this->email->send())
			// {
			// 	$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
			// }else
			// {
			// show_error($this->email->print_debugger());
			// }
			
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
                if ($login_result) {
                    if($login_result == 1){
                        $output = array ('status' => 'Error', 'message' => 'OTP not verified');
						$this->response($output);
                    }else{
                        $output = array ('status' => 'Success', 'message' => 'Login successfully','data'=>$login_result);
						$this->response($output);
                    }
                   
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Invalid login credentials');
					$this->response($output);
                }
        } else {
            $output = array ('status' => 'error', 'message' => 'Please enter mobile number and password');
			$this->response($output);
        }
    }

	public function check_customer_otp(){
		$json_input = $this->_get_customer_post_values();
        if (!empty($json_input)) {
                $otp_result = $this->api_model->check_customer_otp($json_input['customer_id']);
                if (!empty($otp_result) && $otp_result['iOtpCode'] == $json_input['otp_code']) {
                    $update_data['tOtpVerify']=1;
                    $this->api_model->update_fields($otp_result['iCustomerId'],$update_data);
                    $output = array ('status' => 'Success','code' => 200 , 'message' => 'Otp Verified successfully','data'=>$otp_result);
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

	public function resend_otp(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$otp = $this->api_model->generateNumericOTP('4');
			$update_data = array();
			if($json_input['type'] == 'forget password' || $json_input['type'] == 'customer_register'){
				$update_data['iOtpCode'] = $otp;
				$update = $this->api_model->update_fields($json_input['customer_id'],$update_data);
				$details = $this->api_model->get_customer_details($customer['iCustomerId']);

				//otp mail sending
				$msg = 'Your Otp code is '.$otp.' - VNR app';
				$sub = 'Registration Otp';


				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'ftwoftesting@gmail.com';
				$config['smtp_pass']    = 'MotivationS@1';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text';
				$config['validation'] = TRUE; // bool whether to validate email or not      
				$this->load->library('email',$config);

				$this->email->initialize($config);

				$this->email->from('ftwoftesting@gmail.com','Tester');
				$this->email->to($details['vEmail']); 
				$this->email->subject($sub);
				$this->email->message($msg);  

				$this->email->send();
				if($details){
				$output = array('status' => 'Success', 'message' => 'Otp sent successfully','data'=>$details);
				}else{
				$output = array('status' => 'Error', 'message' => 'User not found');
				}
				$this->response($output);
			}

			if($json_input['type'] == 'employee_login' || $json_input['type'] == 'employee_register' || $json_input['type'] == 'employee_forget_password'){
				$update_data['iOtpCode'] = $otp;
				$login = $this->api_model->update_officer_details('iPoliceOfficerId',$json_input['employee_id'],$update_data);
				$employee_details = $this->api_model->get_police_officer_by_insert_id($json_input['employee_id']);
				//otp mail sending
				$msg = 'Your Otp code is '.$otp.' - VNR app';
				$sub = 'Registration Otp';


				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'ftwoftesting@gmail.com';
				$config['smtp_pass']    = 'MotivationS@1';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text';
				$config['validation'] = TRUE; // bool whether to validate email or not      
				$this->load->library('email',$config);

				$this->email->initialize($config);

				$this->email->from('ftwoftesting@gmail.com','Tester');
				$this->email->to($employee_details[0]['iEmail']); 
				$this->email->subject($sub);
				$this->email->message($msg);  

				$this->email->send();
				$details = $this->api_model->get_police_officer_by_insert_id($json_input['employee_id']);
				if($details){
				$output = array('status'=>'success','message'=>'otp sent successfully','data'=>$details);
				}else{
				$output = array('status' => 'Error', 'message' => 'User not found');
				}
				$this->response($output);
			}

		}else
		{
			$output = array ('status' => 'Error', 'message' => 'Please enter input data');
            $this->response($output);
		}

		
	}

	public function get_locked_home_details(){
		// print_r($_FILES);exit;
		$data_input = $this->_get_customer_post_values();
		if(!empty($_POST)){
			$data_input = $_POST;
		}
		// $files_data = $_FILES;
		// $data_input = file_get_contents('php://input');
		// print_r($data_input);
		// print_r($files_data);exit;

		// print_r($_FILES);
		if (!empty($data_input)) {
			
			// $upload_path = '"'.base_url().'upload/"';
			// $config['upload_path'] = $upload_path;
			// $config['allowed_types'] = 'wmv|mp4|avi|mov';
			// $config['max_size'] = '0';
			// $config['max_filename'] = '255';
			// $config['encrypt_name'] = FALSE;
			// $config['file_name'] = 'LockedHome-'.''.rand(10000, 10000000);
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config);
			// if (!$this->upload->do_upload('video')) # form input field attribute
			// {
			// 	# Upload Failed
			// 	$output = array('status'=>'error','message'=>'video update failed');
			// 	$this->response($output);
			// 	exit;
			// }
			// else
			// {

			// 	$file = $configVideo['file_name'];
			// 	echo $file;
			// 	// # Upload Successfull
			// 	// $url = 'assets/gallery/images'.$video_name;
			// 	// $set1 =  $this->Model_name->uploadData($url);
			// 	// $this->session->set_flashdata('success', 'Video Has been Uploaded');
			// 	// redirect('controllerName/method');
			// }
			
			foreach($_FILES as $image){
				$gallaryimage = $image['name'];
				$gallarytype = $image['type'];
				$gallarysize = $image['size'];
				$gallarytmp_name = $image['tmp_name'];

				
                for ($i = 0; $i < count($gallaryimage); $i++) {
					$gallary1_ext =array();
					$allowed = array();
                    $gallary1image = $gallaryimage[$i];
                    $gallary1_ext = pathinfo($gallary1image, PATHINFO_EXTENSION);

					
                    $gallary1_name = "LockedHome-" . rand(10000, 10000000) . "." . $gallary1_ext;
                    $gallary1_type = $gallarytype[$i];
                    $gallary1_size = $gallarysize[$i];
                    $gallary1_tem_loc = $gallarytmp_name[$i];
                    $gallary1_store = FCPATH . "uploads/" . $gallary1_name;
					// print_r($gallary1_ext);exit;
                    $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');

                    if (in_array($gallary1_ext, $allowed)) {
                        if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                            $filename = $gallary1_name;

                        }
                    }
				// print_r($imagename);exit;

                }
			}
			$customer = array();
			$customer['iCustomerId'] = $data_input['customer_id'];
			$customer['dFromDate'] = $data_input['startdate'];
			$customer['dToDate'] = $data_input['Enddate'];
			$customer['vCustomerName'] = $data_input['customer_name'];
			$customer['vAddress'] = $data_input['address'];
			$customer['iPhoneNumber'] = $data_input['mobile_number'];
			$customer['iPincode'] = $data_input['pincode'];
			$customer['iIdProofNumber'] = $data_input['identification_number'];
			$customer['vIdProoftype'] = $data_input['identification_number_type'];
			$customer['vRemarks'] = $data_input['remarks'];
			$customer['vAttachment'] = $filename;
			$customer['tStatus'] = 1;

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
				$notification_data = array();
				$notification_data['iCustomerId'] = $data_input['customer_id'];
				$notification_data['vNotificationContent'] = ucfirst($data_input['customer_name'])." is out of station from ".$home_details['dFromDate']." to ".$home_details['dToDate'];
				$notify = $this->api_model->get_notification($notification_data);
				$this->response([
					'status' => "Success",
					'code'=>"200",
					'message' => 'The details has been registered successfully.',
					'customer_data' => $home_details,$notify
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
			$user_details = $this->api_model->get_customer_details($json_input['customer_id']);
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

	public function update_profile_details(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$customer['vCustomerName'] = $json_input['consumer_name'];
			$customer['vEmail'] = $json_input['email_id'];
			$customer['dDob'] = $json_input['dob'];
			$customer['iMobileNumber'] = $json_input['mobile_number'];
			// $customer['vPassword'] = $json_input['password'];
			$customer['vAddress'] = $json_input['address'];
			$customer['iPincode'] = $json_input['pincode'];
			$customer['vProfession'] = $json_input['profession'];
			$check_duplicate_email = $this->api_model->check_field_exists('vEmail',$json_input['email_id'],$json_input['customer_id']);
			if($check_duplicate_email){
				$output = array ('status' => 'Error', 'message' => 'Email Address Already Exists');
				$this->response($output);
				exit;
			}
			$profile = $this->api_model->update_fields($json_input['customer_id'],$customer);
                if ($profile) {
                    $update_data = $this->api_model->check_customer_otp($json_input['customer_id']);
                    $output = array ('status' => 'Success', 'message' => 'Profile details updated','data'=>$update_data);
					$this->response($output);
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Profile details not updated');
					$this->response($output);
                }

		} else {
			$output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function customer_logout(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$logout = $this->api_model->get_customer_details($json_input['customer_id']);
			if($logout){
				$update = array();
				$update['tLoginStatus'] = 0;
				$this->api_model->update_fields($logout['iCustomerId'],$update);
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

				//Otp mail sending
				$msg = 'Your Otp code is '.$otp.' - VNR app';
				$sub = 'Registration Otp';


				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'ftwoftesting@gmail.com';
				$config['smtp_pass']    = 'MotivationS@1';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text';
				$config['validation'] = TRUE; // bool whether to validate email or not      
				$this->load->library('email',$config);

				$this->email->initialize($config);

				$this->email->from('ftwoftesting@gmail.com','Tester');
				$this->email->to($customer['vEmail']); 
				$this->email->subject($sub);
				$this->email->message($msg);  

				$this->email->send();
				
				$details = $this->api_model->get_customer_details($customer['iCustomerId']);
				$output = array(
					'status' => 'success', 'code' =>200 ,'message' => 'OTP sent successfully','data'=> $details
				);
				$this->response($output);
			}else{
				$output = array(
					'status' => 'error', 'code'=>415 , 'message' => 'Invalid credentials'
				);
				$this->response($output);
			}
        } else {
            $output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
        }
    }

	// public function resend_otp(){
	// 	$json_input = $this->_get_customer_post_values();
	// 	$this->customer_resend_otp($json_input);
	// }

	public function otp_verify(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			if($json_input['type'] == 'forget password'){
				$otp_result = $this->api_model->check_customer_otp($json_input['customer_id']);
                if (!empty($otp_result) && $otp_result['iOtpCode'] == $json_input['otp_code']) {
                    $update_data['tForgotPwdOtpVerify']=1;
                    $this->api_model->update_fields($otp_result['iCustomerId'],$update_data);
                    $output = array ('status' => 'Success','code' => 200 , 'message' => 'Otp Verified successfully');
                    $this->response($output);
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Invalid OTP');
                    $this->response($output);
                }
			}
		}else {
            $output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
        }
	}

	public function change_forgot_password(){
		$json_input  = $this->_get_customer_post_values();
		if(!empty($json_input)){
			if($json_input['password'] == $json_input['conform_password']){
				$customer['vPassword'] = md5($json_input['password']);
				$this->api_model->update_fields($json_input['customer_id'],$customer);
				$output = array ('status' => 'success','code'=>200, 'message' => 'Password changed successfully');
				$this->response($output);
			}else{
				$output = array ('status' => 'Error', 'message' => 'Password doesnt match');
				$this->response($output);
			}
		}else{
            $output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
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

	public function get_covid_updates(){
		$ads = $this->api_model->get_news();
		if($ads){
			$output = array(
				'status'=> 'Success',
				'message'=>'News list',
				'data' => $ads
			);
			$this->response($output);
		}else{
			$output = array (
				'status' => 'Error', 
				'message' => 'News not found'
			);
			$this->response($output);
		}
	}

	// public function update_locked_home_details(){
	// 	$json_input = $this->_get_customer_post_values();
	// 	if(!empty($json_input)){
	// 		$home['iLockedHomeId'] = $json_input['customer_id'];
	// 		$home['dFromDate'] = $json_input['startdate'];
	// 		$home['dToDate'] = $json_input['Enddate'];
	// 		$home['vCustomerName'] = $json_input['customer_name'];
	// 		$home['iPhoneNumber'] = $json_input['mobile_number'];
	// 		$home['vAddress'] = $json_input['password'];
	// 		$home['iIdProofNumber'] = $json_input['address'];
	// 		$home['iPincode'] = $json_input['pincode'];
	// 		$home['vAttachment'] = $json_input['attachments'];
	// 		$home['vIdProoftype'] = $json_input['identification_number_type'];
	// 		$home['iIdProofNumber'] = $json_input['identification_number'];
			
	// 		$update = $this->api_model->update_locked_home($json_input['customer_id'],$home);
    //             if ($update) {
	// 				$home_details = $this->api_model->get_lockedhome_details_by_insert_id($json_input['customer_id']);
    //                 $output = array ('status' => 'Success', 'code'=>200, 'message' => 'Details updated','data'=>$home_details);
	// 				$this->response($output);
    //             } else {
    //                 $output = array ('status' => 'Error', 'message' => 'Details not updated');
	// 				$this->response($output);
    //             }

	// 	} else {
	// 		$output = array ('status' => 'error', 'message' => 'Please enter input data');
	// 		$this->response($output);
	// 	}
	// }

	public function change_password(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$customer = $this->api_model->get_customer_details($data_input['customer_id']);
			if(md5($data_input['old_password']) == $customer['vPassword']){
				$customer['vPassword'] = md5($data_input['new_password']);
				$this->api_model->update_fields($data_input['customer_id'],$customer);
				$output = array ('status' => 'Success', 'code'=>200, 'message' => 'Password updated successfully');
				$this->response($output);
			}else{
				$output = array ('status' => 'Error', 'message' => 'Wrong password entered');
				$this->response($output);
			}
		}else{
			$output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function terms_and_conditions(){
		$terms = $this->api_model->get_terms_and_conditions();
		if($terms){
			$output = array ('status' => 'success', 'message' => $terms);
			$this->response($output);
		}else {
			$output = array ('status' => 'error', 'message' => 'No data found');
			$this->response($output);
		}
	}

	public function get_notifications(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$notifications = $this->api_model->user_notification($data_input['customer_id']);
			if($notifications){
				$output = array(
					'status'=> 'Success',
					'message'=>'Notification list',
					'data' => $notifications
				);
				$this->response($output);
			}else{
				$output = array (
					'status' => 'Error', 
					'message' => 'Notification not found'
				);
				$this->response($output);
			}
		}

	}

	public function locked_home_update_status(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$home = array();
			$home['tStatus'] = $data_input['status'];
			$home['iPincode'] = $data_input['pincode'];
			$update = $this->api_model->update_lockedhome('iLockedHomeId',$data_input['lockedhomeid'],$home);
			if($update == true){
				$customer = $this->api_model->get_lockedhome_details_by_insert_id($data_input['lockedhomeid']);
				$history = array();
				$history['iCustomerId'] = $customer['iCustomerId'];
				$history['iPoliceOfficerId'] = $data_input['policeofficer_id'];
				$history['iLockedHomeId'] = $data_input['lockedhomeid'];
				$history['vRemarks'] = $data_input['remarks'];
				$history['vAddress'] = $data_input['address'];
				$history['iPincode'] = $data_input['pincode'];

				if($data_input['status'] == 0){
					$history['vStatus'] = 'completed';
				}
				if($data_input['status'] == 1){
					$history['vStatus'] = 'monitoring';
				}
				if($data_input['status'] == 2){
					$history['vStatus'] = 'visited';
				}
				if($data_input['status'] == 3){
					$history['vStatus'] = 'open';
				}
				$this->api_model->get_lockedhome_history($history);
				$details = $this->api_model->get_lockedhome_details_by_insert_id($data_input['lockedhomeid']);
				$notification_data['iCustomerId'] = $customer['iCustomerId'];
				$notification_data['vNotificationContent'] = 'Your home was visited';
				$notify = $this->api_model->get_notification($notification_data);
				$output = array('status' => 'success','code'=>200, 'message' => 'status updated successfully','data' => $details,$notify);
				$this->response($output);
			}else{
				$output = array('status'=>'error','message' =>'status not updated');
				$this->response($output);
			}
		}else{
			$output = array('status'=>'error','message' =>'please enter input data');
			$this->response($output);
		}
	}

	public function get_locked_home_list(){
		$details = $this->api_model->get_home_details();
		if($details){
			$output = array('status'=>'success','code'=>200,'message'=>'details displayed successfully','data'=>$details);
			$this->response($output);
		}else{
		$output = array('status'=>'error','message'=>'No data found');
		$this->response($output);
		}
		
	}

	public function employee_register(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){


			$fileNames = "";
			if (!empty($_FILES['image']['name'])) {
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				 if ($this->upload->do_upload('image')) {
					$data      = $this->upload->data();
					$fileName = $data['file_name'];
				}
			}


			$employee = array();
			$employee['vOfficerName'] = $json_input['officer_name'];
			$employee['iEmail'] = $json_input['email_id'];
			$employee['iPoliceStationId'] = $json_input['station_name'];
			$employee['iMobileNumber'] = $json_input['contact_number'];
			$employee['vPassword'] = $json_input['password'];
			$employee['iDepartmentId'] = $json_input['department'];
			$employee['iDesignationId'] = $json_input['designation'];
			// $employee['iGroupid'] = $json_input['group'];
			$employee['iPincode'] = $json_input['pincode'];
			$employee['vGender'] = $json_input['gender'];
			$employee['vAddress'] = $json_input['address'];
			// $employee['tImage'] = $fileName;
			$otp = $this->api_model->generateNumericOTP('4');
			$employee['iOtpCode'] = $otp;
			// print_r($employee);exit;
			if($employee['vOfficerName'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Name is required");
					
					$this->response($output);
				exit;
			}
			if($employee['iEmail'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Email number is required");
					$this->response($output);
				exit;
			}
			if($employee['iPoliceStationId'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Police station is required");
					$this->response($output);
				exit;
			}
			if($employee['iMobileNumber'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Mobile is required");
					$this->response($output);
				exit;
			}
			if($employee['vPassword'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Password is required");
					$this->response($output);
				exit;
			}
			if($employee['iDepartmentId'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Department is required");
					$this->response($output);
				exit;
			}
			if($employee['iDesignationId'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Designation is required");
					$this->response($output);
				exit;
			}
			if($employee['vGender'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Gender is required");
					$this->response($output);
				exit;
			}
			if($employee['iPincode'] == ""){
				$output = array(
					'status' => 'false',
					'code' => '422',
					'message' => "Pincode is required");
					$this->response($output);
				exit;
			}
			// if($employee['tImage'] == ""){
			// 	$output = array(
			// 		'status' => 'false',
			// 		'code' => '422',
			// 		'message' => "Image is required");
			// 		$this->response($output);
			// 	exit;
			// }
			// if($employee['iGroupid'] == ""){
			// 	$output = array(
			// 		'status' => 'false',
			// 		'code' => '422',
			// 		'message' => "Group is required");
			// 		$this->response($output);
			// 	exit;
			// }
			$is_mobile_number_exists = $this->api_model->is_employee_number_exists($employee['iMobileNumber']);
			if ($is_mobile_number_exists) {
				$output = array(
					'status' => 'false',
					'message' => "The given mobile number already exists.");
					$this->response($output);
				exit;
			}
			$is_email_id_exists = $this->api_model->is_employee_email_exists($employee['iEmail']);
			if ($is_email_id_exists) {
				$output = array(
					'status' => 'false',
					'message' => "The given email already exists.");
					$this->response($output);
				exit;
			}
			$insert = $this->api_model->get_police_officer($employee);
			if (!empty($insert) && $insert != 0) {
				$employee_details = $this->api_model->get_custom_employee_details($insert);
				$this->response([
					'status' => "Success",
					'code'=>"200",
					'message' => 'The employee has been registered successfully.',
					'employee_details' => $employee_details
				]);
			}

			//otp mail sending
			$msg = 'Your Otp code is '.$otp.' - VNR app';
			$sub = 'Registration Otp';


			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.googlemail.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = 'ftwoftesting@gmail.com';
			$config['smtp_pass']    = 'MotivationS@1';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'text';
			$config['validation'] = TRUE; // bool whether to validate email or not      
			$this->load->library('email',$config);

			$this->email->initialize($config);

			$this->email->from('ftwoftesting@gmail.com','Tester');
			$this->email->to($employee['iEmail']); 
			$this->email->subject($sub);
			$this->email->message($msg);  

			$this->email->send();
			
		}else{
		$output = array(
			"status" => "false",
			"code"=> "422",
			"message" => "Provide complete employee information to add.");
			$this->response($output);
		}
	}

	public function employee_login(){
        $data = $this->_get_customer_post_values();
        if (!empty($data)) {
                $login_result = $this->api_model->check_employee_login_details($data);
                if ($login_result) {
                    if($login_result == 1){
                        $output = array ('status' => 'Error', 'message' => 'OTP not verified - Signup again');
						$this->response($output);
                    }else{
						$update = array();
						$otp = $this->api_model->generateNumericOTP('4');
						$update['iOtpCode'] = $otp;
						$login = $this->api_model->update_officer_details('iPoliceOfficerId',$login_result['iPoliceOfficerId'],$update);

						//otp mail sending
						$msg = 'Your Otp code is '.$otp.' - VNR app';
						$sub = 'Registration Otp';


						$config['protocol']    = 'smtp';
						$config['smtp_host']    = 'ssl://smtp.googlemail.com';
						$config['smtp_port']    = '465';
						$config['smtp_timeout'] = '7';
						$config['smtp_user']    = 'ftwoftesting@gmail.com';
						$config['smtp_pass']    = 'MotivationS@1';
						$config['charset']    = 'utf-8';
						$config['newline']    = "\r\n";
						$config['mailtype'] = 'text';
						$config['validation'] = TRUE; // bool whether to validate email or not      
						$this->load->library('email',$config);

						$this->email->initialize($config);

						$this->email->from('ftwoftesting@gmail.com','Tester');
						$this->email->to($login_result['iEmail']); 
						$this->email->subject($sub);
						$this->email->message($msg);  

						$this->email->send();
						$employee_details = $this->api_model->get_police_officer_by_insert_id($login_result['iPoliceOfficerId']);
						if($login){
						$output = array ('status' => 'Success', 'message' => 'Otp sent successfully','data'=>$employee_details);
						$this->response($output);
						}
                    }
                   
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Invalid login credentials');
					$this->response($output);
                }
        } else {
            $output = array ('status' => 'error', 'message' => 'Please enter mobile number and password');
			$this->response($output);
        }
    }

	public function login_employee_otp(){
        $data = $this->_get_customer_post_values();
		if(!empty($data)){
			$otp_verify = $this->api_model->get_police_officer_by_insert_id($data['employee_id']);
			if($otp_verify){
				if($data['otp_code'] == $otp_verify[0]['iOtpCode']){
					$update_data['tLoginStatus'] = 1; 
					$this->api_model->update_officer_details('iPoliceOfficerId',$data_input['employee_id'],$update_data);
					$output = array ('status' => 'Success', 'message' => 'Login successfully','data'=>$otp_verify);
					$this->response($output);
				}else{
					$output = array ('status' => 'Error', 'message' => 'Invalid otp');
					$this->response($output);
				}
			}
		}else{
			$output = array ('status' => 'Error', 'message' => 'User not found');
			$this->response($output);
		}
	}

	public function check_employee_otp(){
        $data = $this->_get_customer_post_values();
		if(!empty($data)){
			$otp_verify = $this->api_model->get_police_officer_by_insert_id($data['employee_id']);
			if($otp_verify){
				if($data['otp_code'] == $otp_verify[0]['iOtpCode']){
					$update_data = array();
					$update_data['tOtpVerify'] = 1;
					$update = $this->api_model->update_officer_details('iPoliceOfficerId',$data['employee_id'],$update_data);
					$employee = $this->api_model->get_police_officer_by_insert_id($data['employee_id']);
					$output = array ('status' => 'Success', 'message' => 'Registration completed successfully','data'=>$employee);
					$this->response($output);
				}else{
					$output = array ('status' => 'Error', 'message' => 'Invalid otp');
					$this->response($output);
				}
			}else {
			$output = array ('status' => 'Error', 'message' => 'User not found');
			$this->response($output);
			}
		}else{
			$output = array ('status' => 'Error', 'message' => 'please enter input data');
			$this->response($output);
		}

	}

	public function employee_generate_otp(){
		$json_input = $this->_get_customer_post_values();
		if (!empty($json_input)) {
			$customer = $this->api_model->employee_forgot_password($json_input);
			if($customer){
				$update_data = array();
				$otp = $this->api_model->generateNumericOTP('4');
				$update_data['iOtpCode'] = $otp;
				$login = $this->api_model->update_officer_details('iPoliceOfficerId',$customer['iPoliceOfficerId'],$update_data);

				//otp mail sending
				$msg = 'Your Otp code is '.$otp.' - VNR app';
				$sub = 'Registration Otp';


				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.googlemail.com';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'ftwoftesting@gmail.com';
				$config['smtp_pass']    = 'MotivationS@1';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text';
				$config['validation'] = TRUE; // bool whether to validate email or not      
				$this->load->library('email',$config);

				$this->email->initialize($config);

				$this->email->from('ftwoftesting@gmail.com','Tester');
				$this->email->to($customer['iEmail']); 
				$this->email->subject($sub);
				$this->email->message($msg);  

				$this->email->send();
				$details = $this->api_model->get_police_officer_by_insert_id($customer['iPoliceOfficerId']);
				$output = array(
					'status' => 'Success', 'code' =>200 ,'message' => 'OTP sent successfully','data'=> $details
				);
				$this->response($output);
			}else{
				$output = array(
					'status' => 'error', 'code'=>415 , 'message' => 'Invalid credentials'
				);
				$this->response($output);
			}
        } else {
            $output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
        }
    }

	public function employee_otp_verify(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			if($json_input['type'] == 'forget password'){
				$details = $this->api_model->get_police_officer_by_insert_id($json_input['employee_id']);
				// print_r($details);exit;
				if($details){
					if($json_input['otp_code'] == $details[0]['iOtpCode']){
						$output = array(
							'status' => 'Success', 'code' =>200 ,'message' => 'OTP verified successfully','data'=> $details
						);
						$this->response($output);
					}else{
						$output = array(
							'status' => 'Error','message' => 'invalid OTP'
						);
						$this->response($output);
					}
				}else{
					$output = array(
						'status' => 'Error','message' => 'User not found'
					);
					$this->response($output);
				}
			}
		}else{
			$output = array(
				'status' => 'Error','message' => 'please enter input data'
			);
			$this->response($output);
		}

	}

	public function get_all_station(){
		$station = $this->api_model->get_station_list();
		if($station){
			$output = array('status'=>'Success','message'=>'police station list displayed successfully','data'=> $station);
		}else{
			$output = array('status'=>'Error','message'=>'No data found');
		}
		$this->response($output);
	}

	public function employee_profile_details(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){
			$details = $this->api_model->get_custom_employee_details($json_input['employee_id']);
			if($details){
				$output = array('status'=>'Success','message'=>'employee details displayed successfully','data'=>$details);
			}else{
				$output = array('status'=>'Success','message'=>'No data found');
			}
			$this->response($output);
		}else{
			$output = array('status'=>'Error','message'=>'Provide valid details');
			$this->response($output);
		}
	}

	public function update_employee_profile(){
		$json_input = $this->_get_customer_post_values();
		if(!empty($json_input)){

			$fileNames = "";
			if (!empty($_FILES['image']['name'])) {
				$config['upload_path']   = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				 if ($this->upload->do_upload('image')) {
					$data      = $this->upload->data();
					$fileName = $data['file_name'];
				}
			}
			$employee = array();
			$employee['vOfficerName'] = $json_input['officer_name'];
			$employee['iMobileNumber'] = $json_input['contact_number'];
			$employee['iEmail'] = $json_input['email_id'];
			$employee['iPoliceStationId'] = $json_input['station_name'];
			$employee['vGender'] = $json_input['gender'];
			$employee['iDepartmentId'] = $json_input['department'];
			$employee['iDesignationId'] = $json_input['designation'];
			$employee['iPincode'] = $json_input['pincode'];
			$employee['vAddress'] = $json_input['address'];
			// $employee['vAttachment'] = $fileName;
			// $employee['iGroupid'] = $json_input['group'];
			$check_duplicate_email = $this->api_model->check_employee_exists('iEmail',$json_input['email_id'],$json_input['employee_id']);
			if($check_duplicate_email){
				$output = array ('status' => 'Error', 'message' => 'Email Address Already Exists');
				$this->response($output);
				exit;
			}
			$check_duplicate_mobile = $this->api_model->check_employee_exists('iEmail',$json_input['email_id'],$json_input['employee_id']);
			if($check_duplicate_mobile){
				$output = array ('status' => 'Error', 'message' => 'Mobile number Address Already Exists');
				$this->response($output);
				exit;
			}
			
			$profile = $this->api_model->update_employee($employee,$json_input['employee_id']);
                if ($profile) {
					$station = array();
					$station['iPincode'] = $json_input['pincode'];
					$station['vAddress'] = $json_input['address'];
					$this->api_model->update_police_station($json_input['station_name'],$station);
                    $update_data = $this->api_model->get_custom_employee_details($json_input['employee_id']);
                    $output = array ('status' => 'Success', 'message' => 'Profile details updated','data'=>$update_data);
					$this->response($output);
                } else {
                    $output = array ('status' => 'Error', 'message' => 'Profile details not updated');
					$this->response($output);
                }

		} else {
			$output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function change_employee_password(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			if($data_input['type'] == 'change_password'){
				$details = $this->api_model->get_police_officer_by_insert_id($data_input['employee_id']);
				if(md5($data_input['old_password']) == $details[0]['vPassword']){
					$update_data['vPassword'] = md5($data_input['new_password']);
					$login = $this->api_model->update_officer_details('iPoliceOfficerId',$data_input['employee_id'],$update_data);
					$output = array ('status' => 'Success', 'code'=>200, 'message' => 'Password changed successfully');
					$this->response($output);
				}else{
					$output = array ('status' => 'Error', 'message' => 'Wrong password entered');
					$this->response($output);
				}
			}
			if($data_input['type'] == 'forgot_password'){
				// $details = $this->api_model->get_police_officer_by_insert_id($data_input['employee_id']);
				if($data_input['password'] == $data_input['confirm_password']){
					$update_data['vPassword'] = md5($data_input['password']);
					$login = $this->api_model->update_officer_details('iPoliceOfficerId',$data_input['employee_id'],$update_data);
					$output = array ('status' => 'Success', 'code'=>200, 'message' => 'Password changed successfully');
					$this->response($output);
				}else{
					$output = array ('status' => 'Error', 'message' => 'password doesnt match');
					$this->response($output);
				}
			}
		}else{
			$output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function department_list(){
		$department = $this->api_model->get_department();
		if($department){
			$output = array('status'=>'success','message'=>'department list','data'=>$department);
		}else{
			$output = array('status'=>'error','message'=>'No data found');
		}
		$this->response($output);
	}

	public function designation_list(){
		$designation = $this->api_model->get_designation();
		if($designation){
			$output = array('status'=>'success','message'=>'designation list','data'=>$designation);
		}else{
			$output = array('status'=>'error','message'=>'No data found');
		}
		$this->response($output);
	}

	public function employee_logout(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$logout = $this->api_model->get_police_officer_by_insert_id($data_input['employee_id']);
			if($logout){
				$update = array();
				$update['tLoginStatus'] = 0;
				$login = $this->api_model->update_officer_details('iPoliceOfficerId',$data_input['employee_id'],$update);
				$output = array(
					'code'=> '200',
					'type'=> 'Success',
					'message' => 'Employee Logged Out Successfully.',
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
			$output = array ('status' => 'error', 'message' => 'Please enter input data');
			$this->response($output);
		}
	}

	public function locked_home_history(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$history = $this->api_model->get_all_lockedhome_history($data_input['customer_id']);
			if($history){
				$output = array('status'=>'success','message'=>'Locked home history list','data'=>$history);
			}else{
				$output = array('status'=>'success','message'=>'User not found');
			}
			$this->response($output);
		}else{
			$output = array('status'=>'success','message'=>'please enter input data');
			$this->response($output);
		}
	}

	// public function get_locked_home_list_by_customer_id(){
	// 	$data_input = $this->_get_customer_post_values();
	// 		if(!empty($data_input)){
	// 			$details = $this->api_model->get_home_details();
	// 			if($details){
	// 				$output = array('status'=>'success','code'=>200,'message'=>'details displayed successfully','data'=>$details);
	// 				$this->response($output);
	// 			}else{
	// 			$output = array('status'=>'error','message'=>'No data found');
	// 			$this->response($output);
	// 			}
	// 		}
	// }
	
	public function locked_home_history_by_officerid(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$history = $this->api_model->get_all_lockedhome_history_by_officer($data_input['officerid'],$data_input['lockedhomeid']);
			if($history){
				$output = array('status'=>'success','message'=>'Locked home history list','data'=>$history);
			}else{
				$output = array('status'=>'success','message'=>'User not found');
			}
			$this->response($output);
		}else{
			$output = array('status'=>'success','message'=>'please enter input data');
			$this->response($output);
		}
	}

	public function locked_home_history_by_customerid(){
		$data_input = $this->_get_customer_post_values();
		if(!empty($data_input)){
			$history = $this->api_model->get_all_lockedhome_history_by_customer($data_input['customerid'],$data_input['lockedhomeid']);
			if($history){
				$output = array('status'=>'success','message'=>'Locked home history list','data'=>$history);
			}else{
				$output = array('status'=>'success','message'=>'User not found');
			}
			$this->response($output);
		}else{
			$output = array('status'=>'success','message'=>'please enter input data');
			$this->response($output);
		}
	}
}
