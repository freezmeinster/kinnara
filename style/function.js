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
   $(document).ready(function() {
     $('[tip]').each(function(){
      $(this).qtip({
          content: {
            text: $(this).attr('tip'),
            },
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

   

function ngajax(id){
   form =  $('#add_playlist'+id+'');
   $.ajax({
   url: form.attr('action'),
   data: form.serialize(),
   type: (form.attr('method')),
   cache: false,	  
   dataType: 'script',
   success: function(data) {
  $('.pesan').hide().html('<h3>'+data+'</h3>').show('slow',function() {
      $('.pesan').hide('slow');
    });
  }
 });
return false;
};

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


