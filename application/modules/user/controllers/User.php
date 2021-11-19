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
   public function logout()
  {  
      $this->load->driver('cache');
      $this->session->unset_userdata('UserId');
      $this->session->sess_destroy();
      $this->cache->clean();
      redirect($this->config->item('base_url'));   
   }
   public function forget_password(){
      $data= array();                         
      $data['title'] = 'password';
      $this->template->set_master_template('../../themes/vnrpolice/template_signin.php');
      $this->template->write_view('content', 'user/forget_password', $data);
      $this->template->render();
   }
   public function check_number(){
         $number = $this->input->post('phone_number');    
         // print_r($number) ;exit;
         $findnumber = $this->User_model->forgetpassword($iPhoneNumber);  

         //  print_r($findnumber);exit;
         if($findnumber == $number){
             echo 1 ;   
         }else{
         // $this->session->set_flashdata('msg',' Email not found!');
       redirect(base_url().'user/','refresh');
   }
//   }
}
}
?>