<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {

	public function __construct() {
        parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// echo 1;exit;
	}

	function customer_register() {
        
		     $data_input = $this->_get_customer_post_values();
		    if (!empty($data_input)) {
		        $customer = array();
		        $customer['vName'] = $data_input['consumer_name'];
				$customer['vEmail'] = $data_input['email_id'];
				$customer['dob'] = $data_input['dob'];
		        $customer['iMobileNumber'] = $data_input['mobile_number'];
		        $customer['vPassword'] = $data_input['password'];
		        $customer['iAadharNo'] = $data_input['aadhar_number'];
				$customer['vEmergencyName'] = $data_input['emergency_name'];
				$customer['iEmergencyNumber'] = $data_input['emergency_number'];
				$customer['dCreatedDate'] = date('Y-m-d h:i:s');
		        // print_r($customer['iEmergencyNumber']);exit;
	
		        if($customer['vName'] == ""){
		            $output = array(
		                'status' => 'false',
		                'code' => '422',
		                'message' => "Name is required");
						echo json_encode($output);
		            exit;
		        }
		        if($customer['iMobileNumber'] == ""){
		            $output = array(
		                'status' => 'false',
		                'code' => '422',
		                'message' => "Mobile number is required");
						echo json_encode($output);
		            exit;
		        }
		        if($customer['vEmail'] == ""){
		            $output = array(
		                'status' => 'false',
		                'code' => '422',
		                'message' => "Email is required");
						echo json_encode($output);
		            exit;
		        }
		        if($customer['vPassword'] == ""){
		            $output = array(
		                'status' => 'false',
		                'code' => '422',
		                'message' => "Password is required");
						echo json_encode($output);
		            exit;
		        }
		        if($customer['vEmergencyName'] == ""){
		            $output = array(
		                'status' => 'false',
		                'code' => '422',
		                'message' => "Emergency name is required");
						echo json_encode($output);
		            exit;
		        }
		        if($customer['iEmergencyNumber'] == ""){
		            $output = array(
		                'status' => 'false',
		                'code' => '422',
		                'message' => "Emergency number is required");
						echo json_encode($output);
		            exit;
		        }
		        $is_mobile_number_exists = $this->api_model->is_mobile_number_exists($customer['iMobileNumber']);
		        if ($is_mobile_number_exists) {
		            // print_r($customer['iMobileNumber']);exit;
		            $output = array(
		                'status' => 'false',
		                'message' => "The given mobile number already exists.");
						echo json_encode($output);
		            exit;
		        }
	
		        $is_email_id_exists = $this->api_model->is_email_id_exists($customer['vEmail']);
		        if ($is_email_id_exists) {
		            $output = array(
		                'status' => 'false',
		                'message' => "The given email already exists.");
						echo json_encode($output);
		            exit;
		        }
		        $insert = $this->api_model->insert_customer_details($customer);
		        if (!empty($insert) && $insert != 0) {
		            $customer_details = $this->api_model->get_customer_details_by_insert_id($insert);
		            // print_r($customer_details);exit;
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
					echo json_encode($output);
				}
		}
}
