<div id="text">
<script type="text/javascript">
$(document).ready(function() 
{
   $('#content img[tooltip]').each(function()
   {
      $(this).qtip({
         content: $(this).attr('tooltip'),
         position: {
                  corner: {
                     tooltip: 'bottomLeft',
                     target : 'topRight'
                  }
               },
          style: {
                  border: {
                     width: 5,
                     radius: 10
                  },
                  padding: 10, 
                  textAlign: 'center',
                  tip: true, 
                  name: 'blue' }

      });
   });
});
</script>

<?php
$id = $GLOBALS['id'];
$this->system_mp3->get_mp3_list($id);
echo "<br><br><br><br><br><br><h1>Music Legend</h1>";
$this->system_mp3->get_cat_legend();
?>
</div>
</div>