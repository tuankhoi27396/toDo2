<?php
Class Item extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        //load model san pham
        $this->load->model('Item_model');
    }
    function view(){
        //Lấy ID của category
        $id = $this->uri->segment(3);
        $id = intval($id);
        $this->load->model('Category_model');
        $category=$this->Category_model->get_info($id);
        if(!$category){
            redirect();
        }
        $this->load->model('Item_model');
        $input_category['where']=array('category_id'=>$id);
        $item_list=$this->Item_model->get_list($input_category);
        $this->data['item_list']=$item_list;
        $this->data['id']=$id;
        //
        $id_item = $this->uri->segment(4);
        $id_item = intval($id_item);
        $item=$this->Item_model->get_info($id_item);
        if(!$item){
            redirect();
        }
        $this->data['item']=$item;
        $this->load->view('page', $this->data);
    }

}