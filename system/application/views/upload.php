<script type="text/javascript">
$(function() {
    $("#button").button();
	});
</script>
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
<tr><td colspan="3"><input id="button" type="submit" value="Upload"></td></tr>
</table>
</form>

</div>
</div> 