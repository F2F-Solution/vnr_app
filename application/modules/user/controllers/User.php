<?php
class User extends MY_Controller {
   public function __construct(){
      parent::__construct();
   //  if(empty($this->session->userdata('UserId'))){
   // }
      $this->load->model('User_model'); 
      $this->load->library('session');  
    }
   //  SIGNIN PAGE
    public function index(){
      // if(empty($this->session->userdata('UserId'))){
      //    redirect($this->config->item('base_url'));
      //  }
         
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
      // print_r($user);exit;
      $login = $this->User_model->verify($user); 
      $this -> session -> set_userdata('UserId',$login['iUserId']);
      if($login){
      redirect($this->config->item('base_url') . 'user/dashboard');
      }else{
         redirect($this->config->item('base_url'));
      }
   }
   //dashboard
   public function dashboard(){
      $data= array();                         
      $data['title'] = 'Dashboard';
      $data['lockedhome'] = $this->User_model->getcount_lockedhome(); //Filter lockedhome 
      $data['policeofficer'] = $this->User_model->getcount_policeofficer(); //Filter policeofficer  
      $data['policestation'] = $this->User_model->getcount_policestation(); //Filter policestation  
      $data['unvisited'] = $this->User_model->getcount_unvisited_home(); //Filter unvisitedlockedhome 
      $this->template->write_view('content', 'user/dashboard', $data);
      $this->template->render();
   }

   public function logout()
{
     $this->session->unset_userdata('UserId');
     $this->session->sess_destroy();
     redirect($this->config->item('base_url'));
   }
  }
?>