<?php
Class Page extends MY_Controller
{
    function index()
    {
        $this->load->view('page',$this->data);
    }
}
?>