<div id="footer_menu">
<?php
$id = $this->session->userdata('id_user');
$user = $this->session->userdata('username');
$password = $this->session->userdata('password');
?>
<a href="<?php echo base_url();?>">Home</a> &nbsp; | &nbsp; 
<?php
 $site = site_url();
 if ($id == ''){
    echo "<a href=\"$site/kinnara/register\">Register</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/login\">Login</a> &nbsp; | &nbsp;";  
 }else {
    echo "<a href=\"$site/kinnara/upload\">Upload</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/group\">Group</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/fresh\">Fresh Music</a> &nbsp; | &nbsp;";
    echo "<a href=\"$site/kinnara/search\">Search</a> &nbsp; | &nbsp;"; 
    echo "<a href=\"$site/kinnara/logout\">Logout</a> &nbsp; | &nbsp;"; 
    if ($GLOBALS['level'] == 0){
    echo "<a href=\"$site/admin\">Admin</a> &nbsp; | &nbsp;";
    }
 }
?>
</div>
<div id="footer">
Copyright 2010 Kinnara.
Design by <a href="http://www.ondieting.com/">On Dieting</a>.
</div>
</div>
</body>
</html>
