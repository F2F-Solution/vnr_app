<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designation_model extends CI_model{
  private $table = 'vnr_police_designation';
  private $column_order = array(null,'vDesignationName','tStatus'); //set column field database for datatable orderable
//   private $column_search = array('Designaton'); //set column field database for datatable searchable 
  private $order = array('iDesignationId' => 'desc'); // default descending order
    public function __construct(){
       $this->load->database();
   }
    //store data into DB
    public function store($user){
        $this->db->insert('vnr_police_designation',$user);
    }
    //list into table
    public function select(){
        $query = $this->db->get('vnr_police_designation');  
        return $query;  
    }
    private function list_data() {  
        $this->db->select('vnr_police_designation.vDesignationName','vnr_police_designation.tStatus');
        $this->db->from('vnr_police_designation');      
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
    public function find_data($iDesignationId){
        $this->db->where('iDesignationId', $iDesignationId);
        $query = $this->db->get('vnr_police_designation');
        return $query->row_array();
    }
    //update data
    public function update_data($data,$iDesignationId){
        $this->db->where('iDesignationId', $iDesignationId);
        $this->db->update('vnr_police_designation',$data);
    }
    //Delete data
    public function delete_data($iDesignationId){
        $this->db->where('iDesignationId', $iDesignationId);
        $this-> db->delete('vnr_police_designation');
    }
}
