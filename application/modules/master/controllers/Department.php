<?php
class Department extends MY_Controller {
   public function __construct(){
             parent::__construct();
             $this->load->model('department_model'); 
             $this->load->library('session');  
    }
    //Department page
    public function index(){
        $data= array();                         
        $data['title'] = 'Department Pages';
        $data['department'] = $this->department_model->select(); 

        $this->template->write_view('content', 'master/department_view', $data);
        $this->template->render();
    }
    //Department add page store data to db
    public function save_data(){
        $user=array(
            'vDepartmentName'=>$this->input->post('department_name'), 
            'tStatus' => $this->input->post('status'),
        );
        $this->department_model->store($user);  
        redirect($this->config->item('base_url') . 'master/department');
      }
      //edit data
      public function edit($iDepartmentId){
        $row = $this->department_model->find_data($iDepartmentId);
        $data['department'] = $row;
        $this->template->write_view('content', 'master/department_view', $data);
        $this->template->render();
      }
      //update data
      public function update($iDepartmentId){
        $data = array(
            'vDepartmentName'=> $this->input->post('department_name'),
            'tStatus'         => $this->input->post('status'),
        );
        $this->department_model->update_data($data,$iDepartmentId);
        redirect($this->config->item('base_url') . 'master/department');
    }
    public function delete($iDepartmentId){
        $this->department_model->delete_data($iDepartmentId);
        redirect($this->config->item('base_url') . 'master/department');
    }
}
?>