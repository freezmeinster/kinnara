<?php
class System_view extends Model {

    function System_view()
    {
        parent::Model();
    }

    function static_view($name){
        $this->db->reconnect();
        $this->db->cache_on();
        $query = $this->db->query("select value from static_view where name like '$name'");
        $row = $query->row_array();
        $value = $row['value'];
        echo "$value Mb";
    }

    function system_info($item){
       if($item == "main_memory"){
        $main_mem = shell_exec("free -m | grep Mem | awk '{print $2}'");
        echo "$main_mem Mb";
       }else if ($item == "main_storage"){
         $main_hd_raw = shell_exec("df -m | grep \"/dev/root\" | awk '{print $2}'");
         $main_hd = $main_hd_raw/1024;
         $data = ceil($main_hd);
         echo "$data Gb";
       }else if ($item == "free_memory"){
         $free_mem = shell_exec("free -m | grep Mem | awk '{print $4}'");
         $main_mem = shell_exec("free -m | grep Mem | awk '{print $2}'");
         $percent = ceil(($free_mem/$main_mem)*100);
         echo "$percent";
       }else if ($item == "free_storage"){
         $main_hd_raw = shell_exec("df -m | grep \"/dev/root\" | awk '{print $2}'");
         $main_hd_raw_free = shell_exec("df -m | grep \"/dev/root\" | awk '{print $4}'");
         $percent = ceil(($main_hd_raw_free/$main_hd_raw)*100);
         echo "$percent";
       }
    }
}
?>
