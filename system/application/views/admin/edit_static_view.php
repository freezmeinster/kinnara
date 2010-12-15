<div id="text">
<h3>Editing content of <?php echo $title;?> Page</h3>
<form action="<?php echo site_url();?>/lib_admin/set_static_view" method="POST">
<input type="hidden" name="title" value="<?php echo $title;?>">
<textarea id="myTextArea" name="content" rows="25" cols="50" style="width: 100%"><?php echo $content?></textarea>
<br>
<input type="submit" value="Edit"> 
</form>
</div>
</div>