<?php
class Manage_ads extends MY_Controller {
   public function __construct(){
             parent::__construct();
             $this->load->model('manage_ads_model'); 
             $this->load->library('session');  
    }
    //Department page
    public function index(){
        $data= array();                         
        $data['title'] = 'Manage ad Page';
        // $data['department'] = $this->department_model->select(); 

        $this->template->write_view('content', 'manage_ads/manage_ads_view', $data);
        $this->template->render();
    }

}
?>