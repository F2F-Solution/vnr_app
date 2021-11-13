<?php
class Admin extends MY_Controller {
   public function __construct(){
      parent::__construct();
      $this->load->model('Admin_model'); 
      $this->load->library('session');  
    }
   //  Admin PAGE
    public function index(){
      $data= array();                         
      $data['title'] = 'Admin Pages';
      $this->template->write_view('content', 'user/admin_view', $data);
      $this->template->render();
     }
     public function get(){
       $id = $_POST['id'];
       $user = $this->Admin_model->select($id);
       echo json_encode($user);
    }
    public function update(){
        $iUserId = $_POST['adminid'];
        // print_r($iUserId);exit;
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
          'iPhoneNumber'=>$this->input->post('phone-number'), 
          'vGender'=>$this->input->post('gender'), 
          'vImage'=>$fileNames, 
        );
            //  print_r($user);exit;
        $this->Admin_model->update_data($user,$iUserId);
        redirect($this->config->item('base_url') . 'user/Admin');
    }
}