<?php
    class Login extends MY_Controller{
        function index(){
            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('login','login','callback_check_login');
                if($this->form_validation->run()){
                    //Tạo biến session để xác định admin đã đăng nhập
                    $this->session->set_userdata('login',true);
                    redirect(admin_url(Home));
                }
            }
            $this->load->view('admin/login/index.php');
        }
        //    Kiểm tra username và password
        function check_login(){
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $password=md5($password);
            $this->load->model('Admin_model');
            $where=array(
                'username'=>$username,
                'password'=>$password
            );
            if($this->Admin_model->check_exists($where)){
                $this->form_validation->set_message(__FUNCTION__,'Đăng nhập thành công');
                return true;
            }
            else{
                $this->form_validation->set_message(__FUNCTION__,'Đăng nhập không thành công');
                return false;
            }
        }
    }

