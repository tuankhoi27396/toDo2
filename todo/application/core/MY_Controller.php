<?php
class MY_Controller extends CI_Controller{
    //Biến dữ liệu gửi sang view
    public $data=array();
    // Constructer
    function __construct(){
        //Kế thừa từ CI_Controller
        parent::__construct();
        //Lấy danh sách category
        $this->load->helper('admin_helper');
        $this->load->model('Category_model');
        $category=$this->Category_model->get_list();
        $this->data['category']=$category;
    }

}
