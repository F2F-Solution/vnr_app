<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_model extends CI_model{
    private $table = 'vnr_police_department';
    private $column_order = array(null, 'vnr_police_department.vDepartmentName','vnr_police_department.tStatus'); 
    // private $column_search = array('vDepartmentName','tStatus'); 
    private $order = array('iDepartmentId' => 'desc'); 
    public function __construct(){
       $this->load->database();
   }
    //store data into DB
    public function store($user){
        $this->db->insert('vnr_police_department',$user);
    }
    //list into table
    public function select(){
        $query = $this->db->get('vnr_police_department');  
        return $query;  
    }
    private function list_data() {    
        $this->db->select('vnr_police_department.iDepartmentId,vnr_police_department.vDepartmentName,vnr_police_department.tStatus');
        $this->db->from('vnr_police_department');    
         $i = 0; 
         foreach ($this->column_search as $item) {
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
     //list into table
     public function listtable_data() {
             $this->list_data();
             if($_POST['length'] != -1)
             $this->db->limit($_POST['length'], $_POST['start']);
             $query = $this->db->get();
             return $query->result();
     }
     function count_filtered_gen_posts() {
             $this->list_data();
             $query = $this->db->get();
             return $query->num_rows();
     }
    //edit data
    public function find_data($iDepartmentId){
        $this->db->where('iDepartmentId', $iDepartmentId);
        $query = $this->db->get('vnr_police_department');
        return $query->row_array();
    }
    //update data
    public function update_data($data,$iDepartmentId){
        $this->db->where('iDepartmentId', $iDepartmentId);
        $this->db->update('vnr_police_department',$data);
    }
    //Delete data
    public function delete_data($iDepartmentId){
        $this->db->where('iDepartmentId', $iDepartmentId);
        $this-> db->delete('vnr_police_department');
    }
}