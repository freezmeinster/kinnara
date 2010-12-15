<div id="main">
<div id="sidebar">
<h2>Server Status</h2>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#free_mem').load('<?php echo site_url();?>/admin/sysinfo/free_memory').fadeIn("slow");
$('#free_storage').load('<?php echo site_url();?>/admin/sysinfo/free_storage').fadeIn("slow");
$('#uptime').load('<?php echo site_url();?>/admin/sysinfo/uptime').fadeIn("slow");
}, 500); 
</script>
<table>
<tr><td><h3>Memory</h3></td><td></td><td></td></tr>
<tr><td>Main Memory</td><td>:</td><td><?php $this->system_view->system_info('main_memory');?></td>
<tr><td>Free Memory</td><td>:</td><td><div id="free_mem"></div></td>
<tr><td><h3>Storage</h3></td><td></td><td></td></tr>
<tr><td>Main Storage</td><td>:</td><td><?php $this->system_view->system_info('main_storage');?></td>
<tr><td>Free Storage</td><td>:</td><td><div id="free_storage"></div></td>
<tr><td><h3>Uptime</h3></td><td></td><td></td></tr>
<tr><td>Server uptime</td><td>:</td><td><div id="uptime"></div></td></tr>
<tr><td><h3>User</h3></td><td></td><td></td></tr>
<tr><td>Registerd User</td><td>:</td><td><?php $this->system_view->system_info('user');?> Persons</td></tr>
</table>
</div>