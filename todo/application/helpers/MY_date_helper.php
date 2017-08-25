<?php
/*
 * Lấy ngày từ dạng int
 * @$time:int=thoi gian muon hien thi ngay
 * @$full_time: cho biet co lay gia tri gio phut giay hay khong
 * */
function get_date($time, $full_time=true){
    $format='%d-%m-%y';
    if($full_time){
        $format=$format.' - %h:%i:%s';
    }
    $date=mdate($format,$time);
    return $date;
}