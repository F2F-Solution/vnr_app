<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group_model extends CI_model{
    public function __construct(){
        $table = 'vnr_police_group';
        $column_order = array(null, 'S.No','Group','Status','Actions'); //set column field database for datatable orderable
        $column_search = array('Group'); //set column field database for datatable searchable 
        $order = array('id' => 'desc'); // default descending order
       $this->load->database();
   }
    //store data into DB
    public function store($user){
        $this->db->insert('vnr_police_group',$user);
    }
    //list into table
    public function select(){
        $query = $this->db->get('vnr_police_group');  
        return $query;  
    }
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

    //list into table
    public function listtable_data() {
        $this->list_data();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select('*');
        $this->db->from('vnr_police_group');
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_gen_posts() {
        $this->list_data();
            $query = $this->db->get('vnr_police_group');
        return $query->num_rows();
    }
    //edit data
    public function find_data($iGroupid){
        $this->db->where('iGroupid', $iGroupid);
        $query = $this->db->get('vnr_police_group');
        return $query->row_array();
    }
    //update data
    public function update_data($data,$iGroupid){
        $this->db->where('iGroupid', $iGroupid);
        $this->db->update('vnr_police_group',$data);
    }
    //Delete data
    public function delete_data($iGroupid){
        $this->db->where('iGroupid', $iGroupid);
        $this-> db->delete('vnr_police_group');
    }
    
}