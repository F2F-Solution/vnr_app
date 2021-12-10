<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_model extends CI_model{
 private  $table = 'vnr_news';
 private  $column_order = array(null, 'vNewsSubject','vNewsMessage','tNewsStatus'); //set column field database for datatable orderable
//  private  $column_search = array('vNewsSubject'); //set column field database for datatable searchable 
 private  $order = array('inewsid' => 'desc'); // default descending order
    public function __construct(){
        $this->load->database();
    }
    public function store($user){
        $this->db->insert('vnr_news',$user);
    }
     //list data
     private function list_data() {        
        $this->db->select('inewsid,vNewsSubject,vNewsMessage,vNewsImage,tNewsStatus');
        $this->db->from('vnr_news');
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
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all() {
        $this->db->get('vnr_news');
        return $this->db->count_all_results();
    }

    function count_filtered_gen_posts() {
        $this->list_data();
        $query = $this->db->get();
        return $query->num_rows();
    }
     // edit data
     public function find_data($inewsid){
        $this->db->where('inewsid', $inewsid);
        $query = $this->db->get('vnr_news');
        return $query->row_array();
    }
     //update data
     public function update_data($data,$inewsid){
        $this->db->where('inewsid', $inewsid);
        $this->db->update('vnr_news',$data);
        // print_r($this->db->last_query());exit;
    }
     //Delete data  
     public function delete_data($inewsid){
        $this->db->where('inewsid', $inewsid);
        $this-> db->delete('vnr_news');
    }
}