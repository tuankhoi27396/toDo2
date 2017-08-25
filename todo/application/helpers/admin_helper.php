<?php
//Sử dựng để tạo link xử lí trong Admin
    function admin_url($url=""){
        return base_url('admin/'.$url);
    }