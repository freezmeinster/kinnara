
<script type="text/javascript">
(function($){
 $.fn.extend({
 
 	customStyle : function(options) {
	  if(!$.browser.msie || ($.browser.msie&&$.browser.version>6)){
	  return this.each(function() {
	  
			var currentSelected = $(this).find(':selected');
			$(this).after('<span class="customStyleSelectBox"><span class="customStyleSelectBoxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:$(this).next().css('font-size')});
			var selectBoxSpan = $(this).next();
			var selectBoxWidth = parseInt($(this).width()) - parseInt(selectBoxSpan.css('padding-left')) -parseInt(selectBoxSpan.css('padding-right'));			
			var selectBoxSpanInner = selectBoxSpan.find(':first-child');
			selectBoxSpan.css({display:'inline-block'});
			selectBoxSpanInner.css({width:selectBoxWidth, display:'inline-block'});
			var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
			$(this).height(selectBoxHeight).change(function(){
				//selectBoxSpanInner.text($(this).val()).parent().addClass('changed');
selectBoxSpanInner.text($(this).find(':selected').text()).parent().addClass('changed');
			});
			
	  });
	  }
	}
 });
})(jQuery);


$(function(){

$('select').customStyle();

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
<tr><td>Permission</td><td>:</td><td><select name="permission" class="styled"><option value="0">Public</option><option value="1">Private</option></select></td></tr>
<tr><td>File</td><td>:</td><td><input type="file" name="userfile" class="styled"></td></tr>
<tr><td colspan="3"><input class="button" type="submit" value="Upload"></td></tr>
</table>
</form>

</div>
</div> 