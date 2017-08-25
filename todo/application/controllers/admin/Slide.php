<?php
class Slide extends MY_Controller{
    function __construct(){
        parent::__construct();
        //Load sẵn model cho các hàm
        $this->load->model('Slide_model');
        //$this->load->model('Catalog_model');
    }
    function index(){
        //Lấy tổng số lượng slide
        $total=$this->Slide_model->get_total();
        //Load ra dữ liệu phân trang
        $this->load->library('pagination');
        $input=array();
        //Lấy danh sách sản phẩm
        $list=$this->Slide_model->get_list($input);
        $this->data['list']=$list;
        $this->data['total']=$total;
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //Load view
        $this->data['temp']='admin/slide/index';
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
            $this->form_validation->set_rules('name','Tên slide','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $name=$this->input->post('name');
                $content=$this->input->post('content');
                //Lấy file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path='./upload/slide';
                $upload_data=$this->upload_library->upload($upload_path,'image');
                $image_link='';
                if(isset($upload_data['file_name'])){
                    $image_link=$upload_data['file_name'];
                }

                $data=array(
                    'name'              =>$name,
                    'image_link'        =>$image_link,
                    'link'              =>$this->input->post('link'),
                    'info'              =>$this->input->post('info'),
                    'sort_order'        =>$this->input->post('sort_order'),
                );
                //Thêm mới vào cớ sở dữ liệu
                if($this->Slide_model->create($data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(admin_url('slide'));
            }
        }
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //Load view
        $this->data['temp']='admin/slide/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit(){
        $id=$this->uri->rsegment('3');
        $slide=$this->Slide_model->get_info($id);
        if(!$slide){
            //Tạo ra nội dung thông báo
            $this->session->set_flashdata('message','Không tồn tại slide này!!');
            redirect(admin_url('slide'));
        }
        $this->data['slide']=$slide;
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form, hiển thị lỗi
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('name','Tên slide','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $name=$this->input->post('name');
                $content=$this->input->post('content');
                //Lấy file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path='./upload/slide';
                $upload_data=$this->upload_library->upload($upload_path,'image');
                $image_link='';
                if(isset($upload_data['file_name'])){
                    $image_link=$upload_data['file_name'];
                }

                $data=array(
                    'name'              =>$name,
                    'link'              =>$this->input->post('link'),
                    'info'              =>$this->input->post('info'),
                    'sort_order'        =>$this->input->post('sort_order'),
                );
                if($image_link!=''){
                    $data['image_link']=$image_link;
                }
                //Thêm mới vào cớ sở dữ liệu
                if($this->Slide_model->update($id,$data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(admin_url('slide'));
            }
        }
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //Load view
        $this->data['temp']='admin/slide/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete(){
        $id=$this->uri->rsegment('3');
        $id=intval($id);
        $this->del($id);
        redirect(admin_url('slide'));
    }
    function delete_all(){
        $ids=$this->input->post('ids');
        foreach ($ids as $id){
            $this->del($id);
        }
    }
    function del($id){
        $info=$this->Slide_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại slide này');
            redirect(admin_url('slide'));
        }
        // Thực hiên xóa
        if($this->Slide_model->delete($id)){
            $this->session->set_flashdata('message','Xóa slide thành công');
        }
        else{
            $this->session->set_flashdata('message','Xóa slide thất bại');
        }
        //Xóa các ảnh của sản phẩm
        $image_link='./upload/slide/'.$info->image_link;
        if(file_exists($image_link)){
            unlink($image_link);
        }

    }
}