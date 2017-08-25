<?php
Class Admin extends MY_Controller{
    function __construct(){
        parent::__construct();
        //Load sẵn model cho các hàm
        $this->load->model('Admin_model');
    }
    function index(){
        $input=array();
        $list=$this->Admin_model->get_list($input);
        $total=$this->Admin_model->get_total();
        $this->data['list']=$list;
        $this->data['total']=$total;
        //Lấy nội dung của flash data
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
        $this->data['temp']='admin/admin/index';
        $this->load->view('admin/main',$this->data);
    }
    // Kiểm tra username tồn tại chưa
    function check_username(){
        $username=$this->input->post('username');
        $where=array('username'=>$username);
        //Kiểm tra username đã tồn tại chưa
        if($this->Admin_model->check_exists($where)){
            //Trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__,'Tài khoản đã tồn tại!');
            return false;
        }
        else{
            return true;
        }
    }
    // Thêm mới quản trị viên
    function add(){
        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form
        $this->load->helper('form');
        //Nếu mà có dữ liệu post lên thì kiểm tra.
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('name','Họ và tên','required');
            // Xử dụng rule call back gọi hàm check username kiểm tra xem có trùng username có trong csdl không
            $this->form_validation->set_rules('username','Tên đăng nhập','required|callback_check_username');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[4]');
            $this->form_validation->set_rules('repassword','Mật khẩu xác thực','matches[password]');
            //Nhập liệu chính xác
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $name=$this->input->post('name');

                $username=$this->input->post('username');

                $password=$this->input->post('password');
                $data=array(
                    'name'=>$name,
                    'username'=>$username,
//                    Mã hóa pass theo md5
                    'password'=>md5($password)
                );
                if($this->Admin_model->create($data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Thêm mới dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(admin_url('admin'));
            }
        }
        $this->data['temp']='admin/admin/add';
        $this->load->view('admin/main',$this->data);
    }
    function edit(){
        $id=$this->uri->segment('4');
        $id=intval($id);

        //Sử dụng form_validation để kiểm tra input người dùng nhập vào.
        $this->load->library('form_validation');
        // Load helper Form
        $this->load->helper('form');
        //Lấy thông tin quản trị viên
        $info=$this->Admin_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại Admin');
            redirect(admin_url('admin'));
        };
        $this->data['info']=$info;
        if($this->input->post()){
            //Xét các luật cho các input,'[1]:Tên input','[2]:Tên hiển thị nếu lỗi','[3]:rule', các rule cách nhau dấu |
            $this->form_validation->set_rules('name','Họ và tên','required|min_length[8]');
            // Xử dụng rule call back gọi hàm check username kiểm tra xem có trùng username có trong csdl không
            $this->form_validation->set_rules('username','Tên đăng nhập','required|callback_check_username');
            $password=$this->input->post('password');
            if($password) {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[4]');
                $this->form_validation->set_rules('repassword', 'Mật khẩu xác thực', 'matches[password]');
            }
            if($this->form_validation->run()){
                //thêm vào cơ sở dữ liệu
                $name=$this->input->post('name');
                $username=$this->input->post('username');
                $password=$this->input->post('password');
                $data=array(
                    'name'=>$name,
                    'username'=>$username,
                );
                //Nếu thay đổi mật khẩu thì mới gán dữ liệu
                if($password){
                    //Mã hóa pass theo md5
                    $data['password']=md5($password);
                }
                if($this->Admin_model->update($id,$data)){
                    //Dùng thư viên session tạo flassdata message(Nôi dung thông báo)
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thành công');
                }
                else{
                    $this->session->set_flashdata('message','Cập nhật dữ liệu thất bại');
                }
                //Chuyển đến trang admin.
                redirect(admin_url('admin'));
            }
        }

        $this->data['temp']='admin/admin/edit';
        $this->load->view('admin/main',$this->data);
    }
    function delete(){
        $id=$this->uri->segment('4');
        $id=intval($id);
        //LẤy thông tin của quảng trị viên
        $info=$this->Admin_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message','Không tồn tại Admin');
            redirect(admin_url('admin'));
        }
        // Thực hiên xóa
        if($this->Admin_model->delete($id)){
            $this->session->set_flashdata('message','Xóa Admin thành công');
        }
        else{
            $this->session->set_flashdata('message','Xóa Admin thất bại');
        }
        redirect(admin_url('admin'));
    }
    //Controller đăng xuất
    function logout(){
        if($this->session->userdata('login')){
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }

//    function create(){
//        $data=array();
//        $data['username']='admin1';
//        $data['password']='admin1';
//        $data['name']='Hocphp';
//
//        if($this->Admin_model->create($data)){
//            echo 'Thêm thành công';
//        }
//        else{
//            echo 'Không thêm thành công';
//        }
//    }
//    function update(){
//        $id='8';
//        $data=array();
//        $data['username']='admin2';
//        $data['password']='admin2';
//        $data['name']='Hocphp2';
//        if($this->Admin_model->update($id,$data)){
//            echo 'Cập nhật thành công';
//        }
//        else{
//            echo 'Không cập nhật thành công';
//        }
//    }
//    function delete(){
//        $id='8';
//        if($this->Admin_model->delete($id)){
//            echo 'Xóa thành công';
//        }
//        else{
//            echo 'Không xóa thành công';
//        }
//    }
//    function get_info(){
//        $id='1';
//        $info= $this->Admin_model->get_info($id);
//        echo '<pre>';
//        print_r($info);
//    }
//    function get_list(){
//        $input=array();
//        //$input['where']='id=1';
//        $input['order']=array('id'=>'desc');
//        $input['limit']=array(1,0);
//        $list=$this->Admin_model->get_list($input);
//        echo '<pre>';
//        print_r($list);
//    }
}