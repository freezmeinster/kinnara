<?php
class System_setting extends Model {

    function System_setting()
    {
        parent::Model();
    }

    function get_setting($name){
        $this->db->reconnect();
        $this->db->cache_on();
        $query = $this->db->query("select value from setting where name like '$name'");
        $row = $query->row_array();
        $value = $row['value'];
        echo $value;
    }
}
?>