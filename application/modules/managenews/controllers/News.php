<?php
class News extends MY_Controller {
   public function __construct(){
             parent::__construct();
            //  $this->load->model('News_model'); 
    }
    //station page
    public function index(){
        $data= array();                         
        $data['title'] = 'news Pages';
        $this->template->write_view('content', 'managenews/news_view', $data);
        $this->template->render();
    }
}