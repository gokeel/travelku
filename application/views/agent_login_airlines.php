<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->
	<noscript class="message black-gradient simpler">
		Your browser does not support JavaScript! Some features won't work as expected...
	</noscript>
	<hgroup id="main-title" class="thin">
		<h1 style="color:white">Login Airlines</h1>
	</hgroup>
	<div class="with-padding">
		<div id="list" style="margin-top:30px"></div>
	</div>
</section>
<script>
	$(function() {
		$( "#tgl-transfer" ).datepicker({"dateFormat": "yy-mm-dd"});
	});

	$( window ).load(function() {
		$.ajax({
			type : "GET",
			url: "<?php echo base_url('index.php/admin/get_assets_airlines');?>",
			//async: false,
			dataType: "json",
			success:function(data){
				var output_str = '<table>';
								
				for (var i=0; i<data.length; i++){
					output_str += '<tr>\
										<td>'+data[i].name+'</td>\
										<td><a href="'+data[i].website+'" target="_blank" style="color:red">'+data[i].website+'</a></td>\
									</tr>';
				}
				output_str += '</table>';
				$('#list').append(output_str);
			}
		})
	})
</script>