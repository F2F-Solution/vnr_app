<?php
class Designation extends MY_Controller {
   public function __construct(){
             parent::__construct();
             $this->load->model('designation_model'); 
             $this->load->library('session');  
    }
    //Designation page
    public function index(){
        $data= array();                         
        $data['title'] = 'Designation Pages';
        $data['designation'] = $this->designation_model->select(); 

        $this->template->write_view('content', 'master/designation_view', $data);
        $this->template->render();
    }
    //designtion add page store data to db
    public function save_data(){
        $user=array(
            'vDesignationName'=>$this->input->post('designation_name'), 
            'tStatus' => $this->input->post('status'),
        );
        $this->designation_model->store($user);  
        redirect($this->config->item('base_url') . 'master/designation');
      }
      //ediit data
      public function edit($iDesignationId){
        $row = $this->designation_model->find_data($iDesignationId);
        $data['designation'] = $row;
        $this->template->write_view('content', 'master/designation_view', $data);
        $this->template->render();
      }
      //update data
      public function update($iDesignationId){
        $data = array(
            'vDesignationName'=> $this->input->post('designation_name'),
            'tStatus'         => $this->input->post('status'),
        );
        $this->designation_model->update_data($data,$iDesignationId);
        redirect($this->config->item('base_url') . 'master/designation');
    }
    public function delete($iDesignationId){
        $this->designation_model->delete_data($iDesignationId);
        redirect($this->config->item('base_url') . 'master/designation');
    }
}
?>