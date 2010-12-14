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
        echo $value;  
    }
}
?>