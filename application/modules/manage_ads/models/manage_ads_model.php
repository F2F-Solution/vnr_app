<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_ads_model extends CI_model{
    public function __construct(){
         $table = 'vnr_manage_ads';
         $column_order = array(null, 'S.No','ADS tYPE','ADS Content','ADS image','Actions'); //set column field database for datatable orderable
         $column_search = array('ADS tYPE'); //set column field database for datatable searchable 
         $order = array('id' => 'desc'); // default descending order
        $this->load->database();
    }
    public function store($user){
        $this->db->insert('vnr_manage_ads',$user);
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
        $this->db->select('*');
        $this->db->from('vnr_manage_ads');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all() {
        $this->db->get('vnr_manage_ads');
        return $this->db->count_all_results();
    }

    function count_filtered_gen_posts() {
        $this->list_data();
        $query = $this->db->get('vnr_manage_ads');
        return $query->num_rows();
    }
     // edit data
     public function find_data($iAdId){
        $this->db->where('iAdId', $iAdId);
        $query = $this->db->get('vnr_manage_ads');
        return $query->row_array();
    }
     //update data
     public function update_data($data,$iAdId){
        $this->db->where('iAdId', $iAdId);
        $this->db->update('vnr_manage_ads',$data);
        // print_r($this->db->last_query());exit;
    }
     //Delete data  
     public function delete_data($iAdId){
        $this->db->where('iAdId', $iAdId);
        $this-> db->delete('vnr_manage_ads');
    }
}