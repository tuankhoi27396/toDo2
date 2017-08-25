<?php
Class Category extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        //load model san pham
        $this->load->model('Category_model');
    }
    function get_items(){
        //Lấy ID của thể loài
        $id = $this->uri->segment(3);
        $id = intval($id);
        $category=$this->Category_model->get_info($id);
        if(!$category){
            redirect();
        }
        $this->load->model('Item_model');
        $input_category['where']=array('category_id'=>$id);
        $item_list=$this->Item_model->get_list($input_category);
        $this->data['item_list']=$item_list;
        $this->data['id']=$id;
        $this->load->view('page', $this->data);
    }

}