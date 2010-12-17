
<div id="text">
<h3>Start upload your Music here</h3>
<form action="<?php echo site_url();?>/lib_kinnara/upload" method="POST" enctype="multipart/form-data">
<table cellpadding="5">
<tr><td>Title</td><td>:</td><td><input type="text" class="input" name="title"></td></tr>
<tr><td>Artist</td><td>:</td><td><input type="text" class="input" name="artist"></td></tr>
<tr><td>Album</td><td>:</td><td><input type="text" class="input" name="album"></td></tr>
<tr><td>Category</td><td>:</td><td><?php $this->system_view->get_cat();?></td></tr>
<tr><td>Permission</td><td>:</td><td><select name="permission"><option value="0">Public</option><option value="1">Group</option><option value="2">Private</option></select></td></tr>
<tr><td>File</td><td>:</td><td><input type="file" name="userfile"></td></tr>
<tr><td>Description</td><td>:</td><td></td></tr>
<tr><td colspan="3"><textarea id="editor1" name="description" rows="4" cols="50" style="width: 100%"></textarea></td></tr>
<tr><td>Lyrics</td><td>:</td><td></td></tr>
<tr><td colspan="3"><textarea id="editor2" name="lyrics" rows="30" cols="50" style="width: 100%"></textarea></td></tr>
<tr><td colspan="3"><input type="submit" value="Upload"></td></tr>
</table>
</form>
</div>
</div> 