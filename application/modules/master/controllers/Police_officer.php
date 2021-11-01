<?php
class Police_officer extends MY_Controller {
   public function __construct(){
             parent::__construct();
             $this->load->model('Policeofficer_model'); 
             $this->load->library('session');  
    }
    //Group page
    public function index(){
        $data= array();                         
        $data['title'] = 'Policeofficer Pages';
        $data['groups'] = $this->Policeofficer_model->getalldesignation(); 
        $this->template->write_view('content', 'master/policeofficer_view', $data);
        $this->template->render();
    }
    //Group add page store data to db
    public function save_data(){
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
            'vOfficerName'=>$this->input->post('name'), 
            'iEmail' => $this->input->post('email'),
            'iMobileNumber' => $this->input->post('number'),
            'vGender'=>$this->input->post('gender'),
            'iDesignationId' => $this->input->post('designation'),
            'iDepartmentId' => $this->input->post('department'),
            'iGroupid' => $this->input->post('group'),
            // 'iPoliceStationId' => $this->input->post('station'),
            'tImage'=> $fileNames,
        );
        $this->Policeofficer_model->store($user);  
        redirect($this->config->item('base_url') . 'master/police_officer');
      }
    //   //edit data
    //   public function edit($iPoliceOfficerId){
    //     $row = $this->group_model->find_data($iPoliceOfficerId);
    //     $data['group'] = $row;
    //     $this->template->write_view('content', 'master/policeofficer_view', $data);
    //     $this->template->render();
    //   }
    //   //update data
    //   public function update($iPoliceOfficerId){
    //     $data = array(
    //         'vOfficerName'=>$this->input->post('name'), 
    //         'iEmail' => $this->input->post('email'),
    //         'iMobileNumber' => $this->input->post('number'),
    //         'iDesignationId' => $this->input->post('designation'),
    //         'iDepartmentId' => $this->input->post('department'),
    //         'iGroupid' => $this->input->post('group'),
    //     );
    //     $this->Policeofficer_model->update_data($data,$iPoliceOfficerId);
    //     redirect($this->config->item('base_url') . 'master/police_officer');
    // }
    // public function delete($iPoliceOfficerId){
    //     $this->Policeofficer_model->delete_data($iPoliceOfficerId);
    //     redirect($this->config->item('base_url') . 'master/police_officer');
    // }
}
?>