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
<h1 padding="50px">Search Result for <?php echo $word;?></h1>
<br><br>
<?php $this->system_mp3->search($word);?>
</div>
</div>