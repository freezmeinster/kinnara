<div id="text">
<div class="pesan"></div>
<?php
$id = $GLOBALS['id'];
$this->system_mp3->get_mp3_list($id,$page);
echo "<br><br><br><br><br><br><h1>Music Legend</h1>";
$this->system_mp3->get_cat_legend();
?>
<div class="pesan"></div>
</div>

</div>