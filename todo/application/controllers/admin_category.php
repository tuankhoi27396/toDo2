<?php
Class Admin_Category extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        //load model san pham
        $this->load->model('Category_model');
    }
    function index(){
        $list=$this->Category_model->get_list();
        $this->data['list']=$list;
        $total=$this->Category_model->get_total();
        $this->data['total']=$total;
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //load View
        $this->data['temp']='admin/category/index';
        $this->load->view('admin/main',$this->data);

    }
    function add(){
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form, hiển thị lỗi
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('name','Tên danh mục','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $name=$this->input->post('name');

                $data=array(
                    'name'=>$name,
                );
                //Thêm mới vào cớ sở dữ liệu
                if($this->Category_model->create($data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(base_url('admin_category'));
            }
        }
        $this->data['temp']='admin/Category/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit(){
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form, hiển thị lỗi
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        $id=$this->uri->rsegment('3');
        $info=$this->Category_model->get_info($id);
        //nếu không lấy được dữ liệu sẽ chuyển về trang danh muc sản phẩm index
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại danh mục này!');
            redirect(admin_url('Category'));
        }
        $this->data['info']=$info;
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('name','Tên danh mục','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $name=$this->input->post('name');

                $data=array(
                    'name'=>$name,
                );
                //Thêm mới vào cớ sở dữ liệu
                if($this->Category_model->update($id,$data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(base_url('admin_category'));
            }
        }

        $this->data['temp']='admin/Category/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete(){
        $id=$this->uri->segment('3');
        $id=intval($id);
        $this->del($id,true);
        redirect(base_url('admin_category'));
    }
    function delete_all(){
        $ids=$this->input->post('ids');
        pre($ids);
        foreach ($ids as $id){
            $this->del($id,true);
        }
    }
    private function del($id,$redirect=true){
        $info=$this->Category_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại danh mục sản phẩm');
            if($redirect){
                redirect(base_url('admin_category'));
            }else{
                return false;
            }
        }
       /* //Kiêm tra xem danh mục này có sản phẩm không.
        $this->load->model('Product_model');
        $product=$this->Product_model->get_info_rule(array('Category_id'=>$id),'id,name');
        if($product){
            $this->session->set_flashdata('message','Danh mục '.$info->name.' chứa sản phẩm '.$product->name.', bạn cần xóa sản phẩm trước khi xóa danh mục');
            if($redirect){
                redirect(admin_url('Category'));
            }
            else{
                return false;
            }

        }*/
        // Thực hiên xóa
        if($this->Category_model->delete($id)){
            $this->session->set_flashdata('message','Xóa danh mục  thành công');
        }
        else{
            $this->session->set_flashdata('message','Xóa danh mục thất bại');
        }
    }

}