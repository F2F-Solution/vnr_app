<?php
class Group extends MY_Controller {
   public function __construct(){
             parent::__construct();
             $this->load->model('group_model'); 
             $this->load->library('session');  
    }
    //Group page
    public function index(){
        $data= array();                         
        $data['title'] = 'Group Pages';
        $data['group'] = $this->group_model->select(); 

        $this->template->write_view('content', 'master/group_view', $data);
        $this->template->render();
    }
    //Group add page store data to db
    public function save_data(){
        $user=array(
            'vGroupName'=>$this->input->post('group_name'), 
            'tStatus' => $this->input->post('status'),
        );
        $this->group_model->store($user);  
        redirect($this->config->item('base_url') . 'master/group');
      }
      //edit data
      public function edit($iGroupid){
        $row = $this->group_model->find_data($iGroupid);
        $data['group'] = $row;
        $this->template->write_view('content', 'master/group_view', $data);
        $this->template->render();
      }
      //update data
      public function update($iGroupid){
        $data = array(
            'vGroupName'      => $this->input->post('group_name'),
            'tStatus'         => $this->input->post('status'),
        );
        $this->group_model->update_data($data,$iGroupid);
        redirect($this->config->item('base_url') . 'master/group');
    }
    public function delete($iGroupid){
        $this->group_model->delete_data($iGroupid);
        redirect($this->config->item('base_url') . 'master/group');
    }
}
?>