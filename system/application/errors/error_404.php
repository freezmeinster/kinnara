<?php
if (!function_exists('get_instance')){
 header('Location:lib_kinnara/error_page');
 }else{
 $CI =& get_instance();
 $CI->load->model('system_view');
 $CI->system_view->error_report("$message");
 }
?>
