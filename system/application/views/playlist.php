<div id="text">
<h1 padding="50px">Your Play List</h1>
<h3>Create New Playlist</h3>
<form action="<?php echo site_url();?>/lib_kinnara/create_playlist/" method="POST">
<table cellpadding="10">
<tr><td>Playlist Name</td><td>:</td><td><input name="name" clas="input" type="text" class="input"></td></tr>
<tr><td colspan="3"><input type="submit" value="Create Playlist" class="button"></td></tr>
</table>
</form>
<div id="message"></div>
<h3>Available Playlist</h3>
<?php 
$id = $GLOBALS['id'];
$this->system_mp3->get_playlist_list($id);
?>
</div>
</div>