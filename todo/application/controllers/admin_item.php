<?php
Class Admin_item extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        //load model san pham
        $this->load->model('Item_model');
    }
    function index(){
        $list=$this->Item_model->get_list();
        $this->data['list']=$list;
        $total=$this->Item_model->get_total();
        $this->data['total']=$total;
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //load View
        $this->data['temp']='admin/item/index';
        $this->load->view('admin/main',$this->data);

    }
    function add(){
        //Lấy danh sách category
        $input=array();
        $this->load->model('Category_model');
        $category=$this->Category_model->get_list($input);
        $this->data['category']=$category;
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form, hiển thị lỗi
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('title','Tên danh mục','required');
            $this->form_validation->set_rules('category','Tên danh mục','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu

                $data=array(
                    'title'=>$this->input->post('title'),
                    'category_id'=>$this->input->post('category'),
                    'description'=>$this->input->post('des'),
                    'created_at'       =>now(),


                );
                //Thêm mới vào cớ sở dữ liệu
                if($this->Item_model->create($data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(base_url('admin_item'));
            }
        }
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        $this->data['temp']='admin/item/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit(){
        //Lấy danh sách category
        $input=array();
        $this->load->model('Category_model');
        $category=$this->Category_model->get_list($input);
        $this->data['category']=$category;
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form, hiển thị lỗi
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        $id=$this->uri->rsegment('3');
        $info=$this->Item_model->get_info($id);
        //nếu không lấy được dữ liệu sẽ chuyển về trang danh muc sản phẩm index
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại danh mục này!');
            redirect(base_url('admin_item'));
        }
        $this->data['info']=$info;
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('title','Tên danh mục','required');
            $this->form_validation->set_rules('category','Tên danh mục','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu

                $data=array(
                    'title'=>$this->input->post('title'),
                    'category_id'=>$this->input->post('category'),
                    'description'=>$this->input->post('des'),
                );
                //Thêm mới vào cớ sở dữ liệu
                if($this->Item_model->update($id,$data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(base_url('admin_item'));
            }
        }
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        $this->data['temp']='admin/item/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete(){
        $id=$this->uri->segment('3');
        $id=intval($id);
        $this->del($id,true);
        redirect(base_url('admin_item'));
    }
    function delete_all(){
        $ids=$this->input->post('ids');
        pre($ids);
        foreach ($ids as $id){
            $this->del($id,true);
        }
    }
    private function del($id,$redirect=true){
        $info=$this->Item_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại danh mục sản phẩm');
            if($redirect){
                redirect(base_url('admin_item'));
            }else{
                return false;
            }
        }
        /* //Kiêm tra xem danh mục này có sản phẩm không.
         $this->load->model('Product_model');
         $product=$this->Product_model->get_info_rule(array('item_id'=>$id),'id,name');
         if($product){
             $this->session->set_flashdata('message','Danh mục '.$info->name.' chứa sản phẩm '.$product->name.', bạn cần xóa sản phẩm trước khi xóa danh mục');
             if($redirect){
                 redirect(admin_url('item'));
             }
             else{
                 return false;
             }
 
         }*/
        // Thực hiên xóa
        if($this->Item_model->delete($id)){
            $this->session->set_flashdata('message','Xóa danh mục  thành công');
        }
        else{
            $this->session->set_flashdata('message','Xóa danh mục thất bại');
        }
    }

}