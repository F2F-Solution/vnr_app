<?php
class User extends MY_Controller {
   public function __construct(){
      parent::__construct();
       
      $this->load->model('User_model'); 
      $this->load->library('session'); 
    }
   //  SIGNIN PAGE
    public function index(){
      if ($this->session->userdata('UserId')) {
         redirect(base_url('user/dashboard') );
      } 
      $data= array();                         
      $data['title'] = 'Signin Pages';
      $this->template->set_master_template('../../themes/vnrpolice/template_signin.php');
      $this->template->write_view('content', 'user/login', $data);
      $this->template->render();
     }
     //SIGNUP PAGE
    public function register_view(){
      $data= array();                         
      $data['title'] = 'Signup Pages';
      $this->template->set_master_template('../../themes/vnrpolice/template_signin.php');
      $this->template->write_view('content', 'user/register', $data);
      $this->template->render();
   }
   //store data into db
   public function login_user(){
  //Uploading Image
      $fileNames = "";
      if (!empty($_FILES['image']['name'])) {
          $config['upload_path']   = './uploads/';
          $config['allowed_types'] = 'jpg|jpeg|png';
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
           if ($this->upload->do_upload('image')) {
              $data      = $this->upload->data();
              $fileNames = $data['file_name'];
           }
      }
      $user=array(
      'vUserName'=>$this->input->post('username'), 
      'vEmail'=>$this->input->post('email'),
      'vPassword'=>md5($this->input->post('password')),
      'iPhoneNumber'=>$this->input->post('phone-number'),
      'vGender'=>$this->input->post('gender'),
      'vImage'=> $fileNames,
      'tStatus' => 1,
       );
      $this->User_model->register_user($user);  
      redirect($this->config->item('base_url'));
   }
   //Validate user
   public function verify_user(){
      $user = array(
      'vEmail'=>$this->input->post('email'),
      'vPassword'=>$this->input->post('password'),
      );
      $login = $this->User_model->verify($user); 
      $this->session->set_userdata('UserId',$login['iUserId']);
      if($login){
      redirect($this->config->item('base_url') . 'user/dashboard');
      }else{
         redirect($this->config->item('base_url'));
      }
   }
   //dashboard
   public function dashboard(){
      if (empty($this->session->userdata('UserId'))) {
         redirect(base_url('/'));
       }
      $data= array();                         
      $data['title'] = 'Dashboard';
      $data['lockedhome'] = $this->User_model->getcount_lockedhome(); //Filter lockedhome 
      $data['policeofficer'] = $this->User_model->getcount_policeofficer(); //Filter policeofficer  
      $data['policestation'] = $this->User_model->getcount_policestation(); //Filter policestation  
      $data['unvisited'] = $this->User_model->getcount_unvisited_home(); //Filter unvisitedlockedhome 
      $this->template->write_view('content', 'user/dashboard', $data);
      $this->template->render();
   }
   // terms and condition
   public function terms_condition(){
      $data= array();                         
      $data['title'] = 'terms';
      $data['terms']=$this->User_model->getlist_terms();  
      // print_r($data);exit;
      $this->template->write_view('content', 'user/terms', $data);
      $this->template->render();
   }
   //Delete data
   public function delete_terms($iTermsandConditionsId){
      $this->User_model->delete_data($iTermsandConditionsId);
      redirect($this->config->item('base_url') . 'user/terms');
   }
   public function get(){
      $iTermsandConditionsId = $_POST['id'];
      $row = $this->User_model->find_data($iTermsandConditionsId);
      echo json_encode($row);
      // print_r($row);exit;
   }
   //update data
   public function update(){
      $iTermsandConditionsId = $_POST['term_id'];
      $user=array(
         'vTermsandConditions'=>$this->input->post('term_name'), 
      );
      //  print_r($user);exit;
      $this->User_model->update_data($user,$iTermsandConditionsId);
      redirect($this->config->item('base_url') . 'user/terms_condition');
   }
   // logout
   public function logout(){  
      $this->load->driver('cache');
      $this->session->unset_userdata('UserId');
      $this->session->sess_destroy();
      $this->cache->clean();
      redirect($this->config->item('base_url'));   
   }
   // forgot password page
   public function forget_password(){
      $data= array();                         
      $data['title'] = 'password';
      $this->template->set_master_template('../../themes/vnrpolice/template_signin.php');
      $this->template->write_view('content', 'user/forget_password', $data);
      $this->template->render();
   }
   // send otp
   public function check_number(){ 
      $number = $this->input->post('phone_number');    
      $findnumber = $this->User_model->forgetpassword($number);  
      if($findnumber){
        $otp = $this->User_model->generateNumericOTP('4');  
        $update['iOtpCode'] = $otp;
        $data['userid'] = $findnumber['iUserId'];
        $this->User_model->otp_generate($findnumber['iPhoneNumber'],$update);
        $this->template->set_master_template('../../themes/vnrpolice/template_signin.php');
        $this->template->write_view('content', 'user/reset_password', $data);
        $this->template->render();
      }else{
        echo "<script>alert('Number does not registered, please try with registerd number!')</script>";
        } 
   }
   //verify otp
     public function verify_otp(){
         $otp = $this->input->post('otp'); 
         $user_id = $this->input->post('user_id'); 
         $verify_otp = $this->User_model->check_otp($otp,$user_id);  
         if($verify_otp){
            $data['userid'] = $user_id;
            $this->template->set_master_template('../../themes/vnrpolice/template_signin.php');
            $this->template->write_view('content', 'user/change_password', $data);
            $this->template->render();
         }else{
            echo "<script>alert('OTP does not match, please enter correct OTP!')</script>";
         }
    }
   //  update password
    public function update_password(){
         $new_password =  $this->input->post('new_password'); 
         $confirm_password =  $this->input->post('confirm_password');
         $user_id = $this->input->post('id'); 
      if($new_password == $confirm_password){
         $data = $this->User_model->update_password($user_id, array('vPassword' => md5($new_password)));
         redirect($this->config->item('base_url'));

      }
      // else{
      //    echo 2;
      // }
   }
}
?>