<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Policeofficer_model extends CI_model{
    public function __construct(){
         $table = 'vnr_police_officer';
         $column_order = array(null, 'S.No','Officer Name','Image','Email','Contact NO','Designation','Department','Group','Police station','Actions'); //set column field database for datatable orderable
         $column_search = array('Officer Name','Image','Email','Contact NO','Designation','Department','Group','Police station'); //set column field database for datatable searchable 
         $order = array('id' => 'desc'); // default descending order
        $this->load->database();
    }
    //fetch data for dropdown list
    public function getalldesignation(){
        $data = array();
        $active = 1;
        $data['designation_name'] = $this->db->query("SELECT * FROM vnr_police_designation where tStatus = $active")->result();
        $data['department_name'] = $this->db->query("SELECT *  FROM vnr_police_department where tStatus = $active")->result();
        $data['group_name'] = $this->db->query("SELECT * FROM vnr_police_group where tStatus = $active")->result();
        return $data;
    }
    public function store($user){
        $this->db->insert('vnr_police_officer',$user);
    }
    //list data
    private function list_data() {        
        $this->db->from($this->table);
        $i = 0; 
        foreach ($this->column_search as $item) 
        {
            if($_POST['search']['value']) 
            {               
                if($i===0) // first loop
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); 
            }
            $i++;
        }       
        if(isset($_POST['order'])) { 
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function listtable_data() {
        
        $this->list_data();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('vnr_police_officer.*,designation.vDesignationName,department.vDepartmentName,group.vGroupName');
        $this->db->from('vnr_police_officer');
        $this->db->join('vnr_police_designation as designation', 'vnr_police_officer.iDesignationId = designation.iDesignationId', 'left');
        $this->db->join('vnr_police_department as department', 'vnr_police_officer.iDepartmentId = department.iDepartmentId', 'left');
        $this->db->join('vnr_police_group as group', 'vnr_police_officer.iGroupid = group.iGroupid', 'left');
        // $this->db->where(array('category' => $category, 'display' => 'true'));       
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all() {
        $this->db->get('vnr_police_officer');
        return $this->db->count_all_results();
    }

    function count_filtered_gen_posts() {
        $this->list_data();
            $query = $this->db->get('vnr_police_officer');
        return $query->num_rows();
    }
   // edit data
    public function find_data($iPoliceOfficerId){
        $this->db->where('iPoliceOfficerId', $iPoliceOfficerId);
        $query = $this->db->get('vnr_police_officer');
        return $query->row_array();
    }
     //update data
     public function update_data($data,$iPoliceOfficerId){
        $this->db->where('iPoliceOfficerId', $iPoliceOfficerId);
        $this->db->update('vnr_police_officer',$data);
    }
    //Delete data
    public function delete_data($iPoliceOfficerId){
        // print_r($iPoliceOfficerId);exit;
        $this->db->where('iPoliceOfficerId', $iPoliceOfficerId);
        $this-> db->delete('vnr_police_officer');
    }
 }