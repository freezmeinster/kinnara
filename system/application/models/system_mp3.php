<?php
class System_mp3 extends Model {

    function System_mp3()
    {
        parent::Model();
    }
    
    function gen_url($id_mp3){
    $stream_url = $this->system_setting->get_setting('stream_url');
    $this->db->reconnect();
    $query = $this->db->query("select * from music where id_music = $id_mp3");
    if ($query->num_rows() > 0){
    $row = $query->row_array();
    $mp3 = $row['file_name'];
    $url = "$stream_url/$mp3.mp3";
    header("Location:$url");
     }else $this->system_view->error_report("Sorry we could find your music with id $id_mp3");
    }
    
    function register_music($user,$filename,$title,$cat,$perm,$desc,$lyrics,$artist,$album){
       $enc_filename = $this->system_setting->hashing($filename);
       $target_upload = $this->system_setting->get_setting('mp3dir');
       $old_file = "$target_upload/$filename.mp3";
       $new_file = "$target_upload/$enc_filename.mp3";
       shell_exec("mv $old_file $new_file");
       $this->db->reconnect();
       $this->db->query("insert into music(id_user,title,desc,permision,file_name,uploaded_date,lastchange_date,lyrics,id_cat,artist,album) values($user,'$title','$desc','$perm','$enc_filename',date('now'),date('now'),'$lyrics','$cat','$artist','$album')");
    }
    
    function get_mp3_list($id_user){
      $limit = 5;
      $base = base_url();
      $site = site_url();
      $i=0;
      echo "<table cellpadding=\"15\"><tr>";
      $this->db->reconnect();
      $query = $this->db->query("select * from music m, category c where c.id_cat = m.id_cat and m.permision = 0 or m.id_user in (SELECT distinct u.id_user FROM user u, join_group j, groups g WHERE j.id_user=u.id_user and j.id_group in (select id_group from join_group where id_user = $id_user)) and m.id_cat = c.id_cat order by uploaded_date desc LIMIT 30");
      foreach($query->result_array() as $row){
        $id = $row['m.id_music'];
        $title = $row['m.title'];
        $category = $row['c.name'];
        if($i < $limit){
        echo "<td>";
	  echo "<table>";
	    echo "<tr><td align=\"center\"><a href=\"$site/kinnara/play/$id\">$title</td></tr>";
	    echo "<tr><td align=\"center\"><img src=\"$base/style/images/$category.png\" height=\"70px\" title=\"$category\"></a></td></tr>";
	  echo "</table>";
        echo "</td>";
         $i++;
        }else{
          echo "</tr><tr>";
          $i=0;
        }
      }
      echo "</tr></table>";
    }
    
      function home_mp3_list($id_user){
      $limit = 5;
      $base = base_url();
      $site = site_url();
      $i=0;
      echo "<table cellpadding=\"15\"><tr>";
      $this->db->reconnect();
      $query = $this->db->query("select * from music m , category c where c.id_cat = m.id_cat and m.id_user = $id_user");
      foreach($query->result_array() as $row){
        $id = $row['m.id_music'];
        $title = $row['m.title'];
        $category = $row['c.name'];
        if($i < $limit){
        echo "<td>";
	  echo "<table>";
	    echo "<tr><td align=\"center\"><a href=\"$site/kinnara/play/$id\">$title</td></tr>";
	    echo "<tr><td align=\"center\"><img src=\"$base/style/images/$category.png\" height=\"70px\" title=\"$category\"></a></td></tr>";
	  echo "</table>";
        echo "</td>";
         $i++;
        }else{
          echo "</tr><tr>";
          $i=0;
        }
      }
      echo "</tr></table>";
    }
    
    function get_cat_legend(){
      $limit = 5;
      $base = base_url();
      $site = site_url();
      $i=0;
      echo "<table cellpadding=\"15\"><tr>";
      $this->db->reconnect();
      $query = $this->db->query("select * from category");
      foreach($query->result_array() as $row){
        $category = $row['name'];
        if($i < $limit){
        echo "<td>";
	  echo "<table>\n";
	    echo "<tr><td align=\"center\"><img src=\"$base/style/images/$category.png\" height=\"70px\" title=\"$category\"></td></tr>\n";
	    echo "<tr><td align=\"center\">$category</td></tr>\n";
	  echo "</table>\n";
        echo "</td>";
        $i++;
        }else{
          echo "</tr><tr>";
          $i=0;
        }
      }
      echo "</tr></table>";
    }
    
    function add_counter($id){
     $this->db->reconnect();
     $query = $this->db->query("select * from music where id_music = $id");
     $row = $query->row_array();
     $current_viewed = $row['viewed'];
     $view = $current_viewed+1;
     $this->db->reconnect();
     $query = $this->db->query("update music set viewed=$view where id_music=$id");
    }
           
}


?>