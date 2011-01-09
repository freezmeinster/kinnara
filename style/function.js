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
   
   $('[title]').each(function()
   {
      $(this).qtip({
          content: {
            text: $(this).attr('title'),
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

   

function ngajax(id){
   form =  $('#add_playlist'+id+'');
   $.ajax({
   url: form.attr('action'),
   data: form.serialize(),
   type: (form.attr('method')),
   cache: false,	  
   dataType: 'script',
   success: function(data) {
   $('.pesan').html('<h2>'+data+'</h2>');	  
  }
 });
return false;
};

function pr(id){
  alert(id);
}


