<div id="text">
<script type="text/javascript">
    $(function (){
        $('a.ajax').click(function() {
            var url = this.href;
            var dialog = $('<div style="display:hidden" title="Add Music to Playlist"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url, 
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                    draggable:false,
                    resizable: false,  
		    modal: true,  
		    width: 400,  
		    height: 200, 
		    hide: "explode"

                    });
                }
            );
            //prevent the browser to follow the link
            return false;
        });
    });
    </script>
<script type="text/javascript">
$(document).ready(function() 
{
   $('#content img[tooltip]').each(function()
   {
      $(this).qtip({
          content: {
            text: $(this).attr('tooltip'),
            },
         position: {
                  corner: {
                     tooltip: 'bottomLeft',
                     target : 'topRight'
                  }
               },
          show: { 
            solo: true 
         },
         hide: 'unfocus',
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
$this->system_mp3->get_mp3_list($id,$page);
echo "<br><br><br><br><br><br><h1>Music Legend</h1>";
$this->system_mp3->get_cat_legend();
?>
</div>
</div>