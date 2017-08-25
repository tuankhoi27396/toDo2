<?php
class News extends MY_Controller{
    function __construct(){
        parent::__construct();
        //Load sẵn model cho các hàm
        $this->load->model('News_model');
        //$this->load->model('Catalog_model');
    }
    function index(){
        //Lấy tổng số lượng bài viết
        $total=$this->News_model->get_total();
        //Load ra dữ liệu phân trang
        $this->load->library('pagination');
        $config =array();
        //Tổng tất cả sản phẩm.
        $config['total_rows']=$total;
        $config['base_url']=admin_url('News/index');
        //Số lượn sản phẩm hiển thị trên 1 trang
        $config['per_page']=7;
        $config['uri_segment']='4';//Phan doan hien thi
        $config['next_link']   = "Trang ke tiep";
        $config['prev_link']   = "Trang truoc";
        //Khởi tạo các cấu hình phân trang
        $this->pagination->initialize($config);

        $segment=$this->uri->segment(4);
        $segment=intval($segment);
        $input=array();
        $input['limit']=array($config['per_page'],$segment);
        //Kiểm tra xem có lọc dữ liệu ko
        $id=$this->input->get('id');
        $id=intval($id);
        $input['where']=array();
        if($id>0){
            $input['where']['id']=$id;
        }
        $title=$this->input->get('title');
        if($title){
            $input['like']=array('title',$title);
        }
        $catalog_id=$this->input->get('catalog');
        $catalog_id=intval($catalog_id);
        if($catalog_id>0){
            $input['where']['catalog_id']=$catalog_id;
        }
        //Lấy danh sách sản phẩm
        $list=$this->News_model->get_list($input);
        $this->data['list']=$list;
        $this->data['total']=$total;
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //Load view
        $this->data['temp']='admin/news/index';
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
            $this->form_validation->set_rules('title','Tên bài viết','required');
            $this->form_validation->set_rules('content','Nội dung bài viết','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $title=$this->input->post('title');
                $content=$this->input->post('content');
                //Lấy file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path='./upload/news';
                $upload_data=$this->upload_library->upload($upload_path,'image');
                $image_link='';
                if(isset($upload_data['file_name'])){
                    $image_link=$upload_data['file_name'];
                }

                $data=array(
                    'title'         =>$title,
                    'content'       =>$content,
                    'image_link'    =>$image_link,
                    'meta_desc'     =>$this->input->post('meta_desc'),
                    'meta_key'      =>$this->input->post('meta_key'),
                    'created'       =>now(),
                );
                //Thêm mới vào cớ sở dữ liệu
                if($this->News_model->create($data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(admin_url('news'));
            }
        }
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        //Load view
        $this->data['temp']='admin/news/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit(){
        $id=$this->uri->rsegment('3');
        $news=$this->News_model->get_info($id);
        if(!$news){
            //Tạo ra nội dung thông báo
            $this->session->set_flashdata('message','Không tồn tại bài viết này!!');
            redirect(admin_url('news'));
        }
        $this->data['news']=$news;
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form, hiển thị lỗi
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('title','Tên bài viết','required');
            $this->form_validation->set_rules('content','Nội dung bài viết','required');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $title=$this->input->post('title');
                $content=$this->input->post('content');
                //Lấy file ảnh minh họa được upload lên
                $this->load->library('upload_library');
                $upload_path='./upload/news';
                $upload_data=$this->upload_library->upload($upload_path,'image');
                $image_link='';
                if(isset($upload_data['file_name'])){
                    $image_link=$upload_data['file_name'];
                }

                $data=array(
                    'title'         =>$title,
                    'content'       =>$content,
                    'meta_desc'     =>$this->input->post('meta_desc'),
                    'meta_key'      =>$this->input->post('meta_key'),
                    'created'       =>now(),
                );
                if($image_link!=''){
                    $data['image_link']=$image_link;
                }
                //Thêm mới vào cớ sở dữ liệu
                if($this->News_model->update($id,$data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(admin_url('news'));
            }
        }
        //Load view
        $this->data['temp']='admin/news/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete(){
        $id=$this->uri->rsegment('3');
        $id=intval($id);
        $info=$this->News_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại bài viết này');
            redirect(admin_url('product'));
        }
        // Thực hiên xóa
        if($this->News_model->delete($id)){
            $this->session->set_flashdata('message','Xóa bài viết thành công');
        }
        else{
            $this->session->set_flashdata('message','Xóa bài viết thất bại');
        }
        //Xóa các ảnh của sản phẩm
        $image_link='./upload/news/'.$info->image_link;
        if(file_exists($image_link)){
            unlink($image_link);
        }
        redirect(admin_url('news'));
    }
    function delete_all(){
        $ids=$this->input->post('ids');
        foreach ($ids as $id){
            $this->del($id);
        }
    }
    function del($id){
        $info=$this->News_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại bài viết này');
            redirect(admin_url('product'));
        }
        // Thực hiên xóa
        if($this->News_model->delete($id)){
            $this->session->set_flashdata('message','Xóa bài viết thành công');
        }
        else{
            $this->session->set_flashdata('message','Xóa bài viết thất bại');
        }
        //Xóa các ảnh của sản phẩm
        $image_link='./upload/news/'.$info->image_link;
        if(file_exists($image_link)){
            unlink($image_link);
        }

    }
}