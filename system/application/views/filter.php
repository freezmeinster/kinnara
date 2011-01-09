<div id="text">
<div class="pesan"></div>
<h1>Filter Music By <?php echo $filter;?></h1>
<?php 
  $site = site_url();
  if($filter == 'nothing'){
     redirect("$site/kinnara/fresh");
  }else if($filter == 'category'){
    $this->system_mp3->filter_mp3_list($value);
  }
?>
</div>
</div>