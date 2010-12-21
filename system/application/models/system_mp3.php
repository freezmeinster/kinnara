<?php
class System_mp3 extends Model {

    function System_mp3()
    {
        parent::Model();
    }
    
    function gen_url($a){
    $id_mp3 = strip_quotes($a);
    $this->system_user->check_session(1);
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
    
    function register_music($a,$b,$c,$d,$e,$f,$g,$h,$i){
       $user = strip_quotes($a);
       $filename = strip_quotes($b);
       $title = strip_quotes($c);
       $cat = strip_quotes($d);
       $perm = strip_quotes($e);
       $desc = strip_quotes($f);
       $lyrics = strip_quotes($g);
       $artist = strip_quotes($h);
       $album = strip_quotes($i);
       $this->system_user->check_session(1);
       $enc_filename = $this->system_setting->hashing($filename);
       $target_upload = $this->system_setting->get_setting('mp3dir');
       $old_file = "$target_upload/$filename";
       $new_file = "$target_upload/$enc_filename.mp3";
       shell_exec("mv \"$old_file\".* $new_file");
       $this->db->reconnect();
       $this->db->query("insert into music(id_user,title,desc,permision,file_name,uploaded_date,lastchange_date,lyrics,id_cat,artist,album) values($user,\"$title\",\"$desc\",\"$perm\",\"$enc_filename\",date('now'),date('now'),\"$lyrics\",\"$cat\",\"$artist\",\"$album\")");
    }
    
    function get_mp3_list($id_user,$page){
      $this->system_user->check_session(1);
      $limit = 5;
      $content_limit = 30;
      $base = base_url();
      $site = site_url();
      $hoi = $page*$content_limit;
      $i=0;
      echo "<table cellpadding=\"15\" id=\"content\"><tr>";
      $this->db->reconnect();
      $query = $this->db->query("select * from music m, category c,user u where u.id_user = m.id_user and c.id_cat = m.id_cat and m.permision = 0 or m.id_user in (SELECT distinct u.id_user FROM user u, join_group j, groups g WHERE j.id_user=u.id_user and j.id_group in (select id_group from join_group where id_user = $id_user)) and m.id_cat = c.id_cat and u.id_user = m.id_user order by uploaded_date desc LIMIT $content_limit OFFSET $hoi");
      foreach($query->result_array() as $row){
        $id = $row['m.id_music'];
        $title = $row['m.title'];
        $category = $row['c.name'];
        $artist = $row['m.artist'];
        $upload = $row['u.name'];
        $viewed = $row['m.viewed'];
        if($i < $limit){
        echo "<td>\n";
	  echo "<table>";
	    echo "<tr><td align=\"center\"><a href=\"$site/kinnara/play/$id\">$title</td></tr>\n";
	    echo "<tr><td align=\"center\"><img src=\"$base/style/images/$category.png\" height=\"70px\" tooltip=\"Uploaded By <br>$upload <br><br> Viewed <br>$viewed Times\"></a></td></tr>\n";
	    echo "<tr><td align=\"center\">By $artist</td></tr>\n";
	    echo "<tr><td align=\"center\"><a href=\"$site/lib_kinnara/add_playlist/$id\" class=\"ajax\">Add To Playlist</a></td></tr>\n";
	  echo "</table>";
        echo "</td>\n";
         $i++;
        }else{
          echo "</tr><tr>";
          $i=0;
        }
      }
      echo "</tr></table>";
      $query2 = $this->db->query("select * from music m, category c,user u where u.id_user = m.id_user and c.id_cat = m.id_cat and m.permision = 0 or m.id_user in (SELECT distinct u.id_user FROM user u, join_group j, groups g WHERE j.id_user=u.id_user and j.id_group in (select id_group from join_group where id_user = $id_user)) and m.id_cat = c.id_cat and u.id_user = m.id_user order by uploaded_date desc");
      $row = $query2->num_rows();
      $hah = ceil($row/$content_limit);
      echo "Page";
      for ($m = 1;$m <= $hah; $m++){
      $wew = $m-1;
      echo "  <a href=\"$site/kinnara/fresh/".$wew."\">$m</a>";
      }
      
    }
    
      function home_mp3_list($id_user){
      $this->system_user->check_session(1);
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
    $this->system_user->check_session(1);
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
    $this->system_user->check_session(1);
     $this->db->reconnect();
     $query = $this->db->query("select * from music where id_music = $id");
     $row = $query->row_array();
     $current_viewed = $row['viewed'];
     $view = $current_viewed+1;
     $this->db->reconnect();
     $query = $this->db->query("update music set viewed=$view where id_music=$id");
    }
    
    function create_playlist($id,$name){
    $this->db->reconnect();
    $query = $this->db->query("select * from playlist where id_user = $id and name like \"%$name%\"");
    $row = $query->num_rows();
    if ($row > 0){
     $this->system_view->error_report("Sorry Playlist $name already exist, Please user other name !");
    }else if($name == ''){
     $this->system_view->error_report("Please fill Playlist name !");
    }else if( $name != ''){
      $this->db->reconnect();
      $this->db->query("insert into playlist(id_user,name,create_date) values($id,\"$name\",date('now'))");
      $this->system_view->success_report("Playlist $name has been successfuly created !");
    }
    }
    
    function get_playlist_list($id){
    $site = site_url();
    $this->db->reconnect();
    $query = $this->db->query("select * from playlist where id_user = $id");
    	foreach($query->result_array() as $row){
    	     $name = $row['name'];
    	     $id_playlist = $row['id_playlist'];
    	     echo "<h4><a href=\"$site/kinnara/listen/$id_playlist\">$name</h4> <a href=\"$site/lib_kinnara/del_playlist/$id_playlist\">Delete Playlist</a> <a href=\"$site/lib_kinnara/empty_playlist/$id_playlist\">Empty Playlist</a>";
    	     echo "<table id=\"perlu\" cellpadding=\"5\">";
    	     echo "<tr><th>No</th><th>Music</th><th>Artist</th><th>Action</th></tr>";
    	     $this->db->reconnect();
    	     $b = $this->db->query("select * from listening l,music m where l.id_music = m.id_music and l.id_playlist = $id_playlist");
    	     $m = 1;
    	     foreach($b->result_array() as $c){
    	     	$title = $c['m.title']; 
    	     	$id_musics = $c['m.id_music'];
    	     	$artist = $c['m.artist'];
    	     	echo "<tr><td>$m</td><td>$title</td><td>$artist</td><td><a href=\"$site/lib_kinnara/del_mp3_from_playlist/$id_playlist/$id_musics\">Delete</a></td></tr>";
    	     	$m++;
    	     }
    	     echo "</table>";
    	}
    }
    
    function add_to_playlist($playlist,$id_music){
    $this->db->reconnect();
    $a = $this->db->query("select * from listening where id_playlist = $playlist and id_music = $id_music");
    $row = $a->num_rows();
     if ($row > 0 ){
        $this->system_view->error_report("This Music already exist in playlist");
     }else if ($row == 0 ){
	  $this->db->reconnect();
	  $this->db->query("insert into listening(id_playlist,id_music) values($playlist,$id_music)");
	  $this->system_view->success_report("Music has been successfuly added to playlist");
     }
    }
    
    function get_xml($id_playlist){
    $site = site_url();
    $this->db->reconnect();
    $query = $this->db->query("select * from music m,listening l, playlist p where m.id_music = l.id_music and p.id_playlist = l.id_playlist and l.id_playlist = $id_playlist");
    $hah = $query->row_array();
    $name = $hah['p.name'];
 
    $xml = new MY_Xml_writer;
    $xml->setRootName('playlist');
    $xml->initiate();
    
    $xml->addNode('title', $name);
    $xml->addNode('creator', 'Kinnara');
    $xml->addNode('link', 'http://192.168.70.248/kinnara');
    $xml->addNode('info', 'Kinnara Upload, Listen and Enjoy It Forever');
    $xml->addNode('image', '');

    $xml->startBranch('trackList');
    
    foreach($query->result_array() as $row){
    $title = $row['m.title'];
    $id_music = $row['m.id_music'];
    $artist = $row['m.artist'];
    $album = $row['m.album'];
    $xml->startBranch('track'); 
    $xml->addNode('location', "$site/lib_kinnara/gen_url/$id_music");
    $xml->addNode('creator', $artist);
    $xml->addNode('album', $album);
    $xml->addNode('title',$title);
    $xml->addNode('annotation', '');
    $xml->addNode('duration', '');
    $xml->addNode('image', '');
    $xml->addNode('info', '');
    $xml->endBranch();
     }
     
    $xml->endBranch();
    
    // Print the XML to screen
    $xml->getXml(true);
    }
    
           
}


?>