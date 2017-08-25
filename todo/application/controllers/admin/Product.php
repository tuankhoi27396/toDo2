<?php
    class Product extends MY_Controller{
        function __construct(){
            parent::__construct();
            //Load sẵn model cho các hàm
            $this->load->model('Product_model');
            $this->load->model('Catalog_model');
        }
        function index(){

            $total=$this->Product_model->get_total();
            //Load ra dữ liệu phân trang
            $this->load->library('pagination');
            $config =array();
            //Tổng tất cả sản phẩm.
            $config['total_rows']=$total;
            $config['base_url']=admin_url('product/index');
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
            $name=$this->input->get('name');
            if($name){
                $input['like']=array('name',$name);
            }
            $catalog_id=$this->input->get('catalog');
            $catalog_id=intval($catalog_id);
            if($catalog_id>0){
                $input['where']['catalog_id']=$catalog_id;
            }
            //Lấy danh sách sản phẩm
            $list=$this->Product_model->get_list($input);
            $this->data['list']=$list;
            //Lấy danh sách danh mục sản phẩm
            $input=array();
            $input['where']=array('parent_id'=>0);
            $catalogs=$this->Catalog_model->get_list($input);
            foreach ($catalogs as $row){
                $input['where']=array('parent_id'=>$row->id);
                $subs=$this->Catalog_model->get_list($input);
                $row->subs=$subs;
            }
            $this->data['catalog']=$catalogs;
            $this->data['total']=$total;
            //Lấy nội dung của flash data
            $message=$this->session->flashdata('message');
            $this->data['message']=$message;
            //Load view
            $this->data['temp']='admin/product/index';
            $this->load->view('admin/main',$this->data);
        }
        function add(){

            //Lấy danh sách danh mục sản phẩm
            $input=array();
            $input['where']=array('parent_id'=>0);
            $catalogs=$this->Catalog_model->get_list($input);
            foreach ($catalogs as $row){
                $input['where']=array('parent_id'=>$row->id);
                $subs=$this->Catalog_model->get_list($input);
                $row->subs=$subs;
            }
            $this->data['catalog']=$catalogs;

            //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
            $this->load->library('form_validation');
            // Load helper Form, hiển thị lỗi
            $this->load->helper('form');
            //Nếu mà có dữ liệu post lên thì kiểm tra.
            if($this->input->post()){
                //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
                $this->form_validation->set_rules('name','Tên danh mục','required|max_length[20]');
                $this->form_validation->set_rules('catalog','Thể loại','required');
                $this->form_validation->set_rules('price','Giá','required');
                //Nhập liệu chính xác
                if($this->form_validation->run()){
                    //thêm vào cơ sở dữ liệu
                    $name=$this->input->post('name');
                    $catalog_id=$this->input->post('catalog');
                    $price=$this->input->post('price');
                    $price=str_replace(',','',$price);
                    //Lấy file ảnh minh họa được upload lên
                    $this->load->library('upload_library');
                    $upload_path='./upload/product';
                    $upload_data=$this->upload_library->upload($upload_path,'image');
                    $image_link='';
                    if(isset($upload_data['file_name'])){
                        $image_link=$upload_data['file_name'];
                    }
                    //Lấy ảnh minh họa kèm theo
                    $image_list=array();
                    $image_list=$this->upload_library->upload_file($upload_path,'image_list');
                    $image_list=json_encode($image_list);

                    $data=array(
                        'name'          =>$name,
                        'catalog_id'    =>$catalog_id,
                        'price'         =>$price,
                        'image_link'    =>$image_link,
                        'image_list'    =>$image_list,
                        'discount'      =>$this->input->post('discount'),
                        'warranty'      =>$this->input->post('warranty'),
                        'gifts'         =>$this->input->post('gifts'),
                        'site_title'    =>$this->input->post('site_title'),
                        'meta_desc'     =>$this->input->post('meta_desc'),
                        'meta_key'      =>$this->input->post('meta_key'),
                        'content'       =>$this->input->post('content'),
                        'video'         =>$this->input->post('video'),
                        'created'       =>now(),
                    );
                    //Thêm mới vào cớ sở dữ liệu
                    if($this->Product_model->create($data)){
                        //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                        $this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
                    }
                    else{
                        $this->session->set_flashdata('message','Thêm mới dữ liệu thất bại');
                    }
                    //Chuyển đến trang admin.
                    redirect(admin_url('product'));
                }
            }
            //Lấy nội dung của flash data
            $message=$this->session->flashdata('message');
            $this->data['message']=$message;
            //Load view
            $this->data['temp']='admin/product/add';
            $this->load->view('admin/main',$this->data);
        }
        function edit(){
            $id=$this->uri->rsegment('3');
            $product=$this->Product_model->get_info($id);
            if(!$product){
                //Tạo ra nội dung thông báo
                $this->session->set_flashdata('message','Không tồn tại sản phẩm này!!');
                redirect(admin_url('product'));
            }
            $this->data['product']=$product;
            //Lấy danh sách danh mục sản phẩm
            $input=array();
            $input['where']=array('parent_id'=>0);
            $catalogs=$this->Catalog_model->get_list($input);
            foreach ($catalogs as $row){
                $input['where']=array('parent_id'=>$row->id);
                $subs=$this->Catalog_model->get_list($input);
                $row->subs=$subs;
            }
            $this->data['catalog']=$catalogs;

            //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
            $this->load->library('form_validation');
            // Load helper Form, hiển thị lỗi
            $this->load->helper('form');
            //Nếu mà có dữ liệu post lên thì kiểm tra.
            if($this->input->post()){
                //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
                $this->form_validation->set_rules('name','Tên danh mục','required|max_length[20]');
                $this->form_validation->set_rules('catalog','Thể loại','required');
                $this->form_validation->set_rules('price','Giá','required');
                //Nhập liệu chính xác
                if($this->form_validation->run()){
                    //thêm vào cơ sở dữ liệu
                    $name=$this->input->post('name');
                    $catalog_id=$this->input->post('catalog');
                    $price=$this->input->post('price');
                    $price=str_replace(',','',$price);
                    $discount=$this->input->post('discount');
                    $discount=str_replace(',','',$discount);
                    //Lấy file ảnh minh họa được upload lên
                    $this->load->library('upload_library');
                    $upload_path='./upload/product';
                    $upload_data=$this->upload_library->upload($upload_path,'image');
                    $image_link='';
                    if(isset($upload_data['file_name'])){
                        $image_link=$upload_data['file_name'];
                    }
                    //Lấy ảnh minh họa kèm theo
                    $image_list=array();
                    $image_list=$this->upload_library->upload_file($upload_path,'image_list');
                    $image_list=json_encode($image_list);

                    $data=array(
                        'name'          =>$name,
                        'catalog_id'    =>$catalog_id,
                        'price'         =>$price,
                        'discount'      =>$discount,
                        'warranty'      =>$this->input->post('warranty'),
                        'gifts'         =>$this->input->post('gifts'),
                        'site_title'    =>$this->input->post('site_title'),
                        'meta_desc'     =>$this->input->post('meta_desc'),
                        'video'         =>$this->input->post('video'),
                        'meta_key'      =>$this->input->post('meta_key'),
                        'content'=>$this->input->post('content'),
                    );
                    if($image_link!=''){
                        $data['image_link']=$image_link;
                    }
                    if(!empty($image_list)){
                        $data['image_list']=$image_list;
                    }
                    //Thêm mới vào cớ sở dữ liệu
                    if($this->Product_model->update($id,$data)){
                        //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                        $this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
                    }
                    else{
                        $this->session->set_flashdata('message','Cập nhật dữ liệu thất bại');
                    }
                    //Chuyển đến trang admin.
                    redirect(admin_url('product'));
                }
            }
            //Load view
            $this->data['temp']='admin/product/edit';
            $this->load->view('admin/main',$this->data);
        }
        function delete(){
            $id=$this->uri->rsegment('3');
            $id=intval($id);
            //LẤy thông tin của quảng trị viên
            $info=$this->Product_model->get_info($id);
            if(!$info){
                $this->session->set_flashdata('message','Không tồn tại sản phẩm');
                redirect(admin_url('product'));
            }
            // Thực hiên xóa
            if($this->Product_model->delete($id)){
                $this->session->set_flashdata('message','Xóa sản phẩm thành công');
            }
            else{
                $this->session->set_flashdata('message','Xóa sản phẩm thất bại');
            }
            //Xóa các ảnh của sản phẩm
            $image_link='./upload/product/'.$info->image_link;
            if(file_exists($image_link)){
                unlink($image_link);
            }
            //Xóa ảnh kèm theo của sản phẩm
            $image_list=json_decode($info->image_list);
            if(is_array($image_list)){
                foreach ($image_list as $img){
                    $image_link='./upload/product/'.$img;
                    if(file_exists($image_link)){
                        unlink($image_link);

                    }
                }
            }
            redirect(admin_url('product'));
        }
        function delete_all(){
            $ids=$this->input->post('ids');
            foreach ($ids as $id){
                $this->del($id);
            }
        }
        function del($id){
            $info=$this->Product_model->get_info($id);
            if(!$info){
                $this->session->set_flashdata('message','Không tồn tại sản phẩm');
                redirect(admin_url('product'));
            }
            // Thực hiên xóa
            if($this->Product_model->delete($id)){
                $this->session->set_flashdata('message','Xóa sản phẩm thành công');
            }
            else{
                $this->session->set_flashdata('message','Xóa sản phẩm thất bại');
            }
            //Xóa các ảnh của sản phẩm
            $image_link='./upload/product/'.$info->image_link;
            if(file_exists($image_link)){
                unlink($image_link);
            }
            //Xóa ảnh kèm theo của sản phẩm
            $image_list=json_decode($info->image_list);
            if(is_array($image_list)){
                foreach ($image_list as $img){
                    $image_link='./upload/product/'.$img;
                    if(file_exists($image_link)){
                        unlink($image_link);

                    }
                }
            }
        }
}