<div id="text">
<div class="content">
            <div class="demo">
                <h1>Demo 1</h1>

                <div id="demo1">                   
                </div>
            </div>
			<div class="demo">
                <h1>Demo 2</h1>
                <div id="demo2">                   
                </div>
            </div>
			<div class="demo">

                <h1>Demo 3</h1>
                <div id="demo3">                   
                </div>
            </div>
			<div class="demo">
                <h1>Demo 4</h1>
                <div id="demo4">                   
                </div>
            </div>

			<div id="paginationdemo" class="demo">
                <h1>Demo 5</h1>
                <div id="p1" class="pagedemo _current" style="">Page 1</div>
				<div id="p2" class="pagedemo" style="display:none;">Page 2</div>
				<div id="p3" class="pagedemo" style="display:none;">Page 3</div>
				<div id="p4" class="pagedemo" style="display:none;">Page 4</div>

				<div id="p5" class="pagedemo" style="display:none;">Page 5</div>
				<div id="p6" class="pagedemo" style="display:none;">Page 6</div>
				<div id="p7" class="pagedemo" style="display:none;">Page 7</div>
				<div id="p8" class="pagedemo" style="display:none;">Page 8</div>
				<div id="p9" class="pagedemo" style="display:none;">Page 9</div>
				<div id="p10" class="pagedemo" style="display:none;">Page 10</div>

				<div id="demo5">                   
                </div>
            </div>
        </div>

<script type="text/javascript">
		$(function() {
			$("#demo1").paginate({
				count 		: 100,
				start 		: 1,
				display     : 8,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press'
			});
			$("#demo2").paginate({
				count 		: 50,
				start 		: 5,
				display     : 10,
				border					: false,
				text_color  			: '#888',
				background_color    	: '#EEE',	
				text_hover_color  		: 'black',
				background_hover_color	: '#CFCFCF'
			});
			$("#demo3").paginate({
				count 		: 50,
				start 		: 20,
				display     : 12,
				border					: true,
				border_color			: '#BEF8B8',
				text_color  			: '#68BA64',
				background_color    	: '#E3F2E1',	
				border_hover_color		: '#68BA64',
				text_hover_color  		: 'black',
				background_hover_color	: '#CAE6C6', 
				rotate      : false,
				images		: false,
				mouse		: 'press'
			});
			$("#demo4").paginate({
				count 		: 50,
				start 		: 20,
				display     : 12,
				border					: false,
				text_color  			: '#79B5E3',
				background_color    	: 'none',	
				text_hover_color  		: '#2573AF',
				background_hover_color	: 'none', 
				images		: false,
				mouse		: 'press'
			});
			$("#demo5").paginate({
				count 		: 10,
				start 		: 1,
				display     : 7,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press',
				onChange     			: function(page){
											$('._current','#paginationdemo').removeClass('_current').hide();
											$('#p'+page).addClass('_current').show();
										  }
			});
		});
		</script>

</div>
</div> 