<div id="text">
<script type="text/javascript">
$(document).ready(function() 
{
    $("#new_profile").hide();
    $("#new_password").hide();
    $(".button").button();
    
    $( "#edit_profile" ).click(function() {
      $("#new_profile").show('clip','slow');
      $("#old_profile").hide();
      $("#new_password").hide();
    });
    
    $( "#edit_cencel" ).click(function() {
      $("#old_profile").show('clip','slow');
      $("#new_profile").hide();
      $("#new_password").hide();
    });
    
      $( "#cencel" ).click(function() {
      $("#old_profile").show('clip','slow');
      $("#new_profile").hide();
      $("#new_password").hide();
    });
    
    $( "#edit_password" ).click(function() {
      $("#new_password").show('clip','slow');
      $("#old_profile").hide();
    });
  
});
</script>
<?php 
$id = $this->session->userdata('id_user');
if ($id == ''){
  echo "<h1>Selamat Datang</h1>";
  echo $this->system_view->static_view($static);
}else if($id != ''){
$this->db->reconnect();
$query = $this->db->query("select * from user where id_user = $id");
$row = $query->row_array();
$username = $row['username'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$website = $row['website'];
$site = site_url();
 echo "<h1>Your Profile</h1>";
echo "<div id=\"new_profile\">\n";
echo "<form action=\"$site/lib_kinnara/edit_profile/echo $id\" method=\"POST\">\n";
echo "<table cellpadding=\"10\">\n";
echo "<tr><td>Sure Name</td><td>:</td><td><input class=\"input\" type=\"text\" name=\"name\" value=\"$name\"></td></tr>\n";
echo "<tr><td>Email</td><td>:</td><td><input class=\"input\" type=\"text\" name=\"email\" value=\"$email\"></td></tr>\n";
echo "<tr><td>Phone</td><td>:</td><td><input class=\"input\" type=\"text\" name=\"phone\" value=\"$phone\"></td></tr>\n";
echo "<tr><td>Web Site</td><td>:</td><td><input class=\"input\" type=\"text\" name=\"web\" value=\"$website\"></td></tr>\n";
echo "</table>\n";
echo "<input type=\"submit\" class=\"button\" id=\"update_profile\" value=\"Update\"> <input type=\"button\" class=\"button\" id=\"edit_cencel\" value=\"Cancel\">\n";
echo "</form>\n";
echo "</div>\n";

echo "<div id=\"new_password\">\n";
echo "<form action=\"$site/lib_kinnara/edit_password/$id\" method=\"POST\">\n";
echo "<table cellpadding=\"10\">\n";
echo "<tr><td>New Password</td><td>:</td><td><input class=\"input\" type=\"password\" name=\"password\"></td></tr>\n";
echo "<tr><td>Confirm Password</td><td>:</td><td><input class=\"input\" type=\"password\" name=\"confirm_password\"></td></tr>\n";
echo "</table>\n";
echo "<input type=\"submit\" class=\"button\" id=\"change_password\" value=\"Update\"> <input type=\"button\" class=\"button\" id=\"cencel\" value=\"Cancel\">\n";
echo "</form>\n";
echo "</div>\n";

  echo "<div id=\"old_profile\">\n";
  $this->load->view('profile');
  echo "<button class=\"button\" id=\"edit_profile\">Edit Profile</button> <button class=\"button\" id=\"edit_password\">Edit Password</button>\n";
  echo "</div>";
  echo "<h1>Your Music</h1>\n";
  $this->system_mp3->home_mp3_list($id);
}
?>



</div>
</div>