<style type="text/css">
.yui3-panel {
    outline: none;
}
.yui3-panel-content .yui3-widget-hd {
    font-weight: bold;
}
.yui3-panel-content .yui3-widget-bd {
    padding: 15px;
}
.yui3-panel-content label {
    margin-right: 30px;
}
.yui3-panel-content fieldset {
    border: none;
    padding: 0;
}
.yui3-panel-content input[type="text"] {
    border: none;
    border: 1px solid #ccc;
    padding: 3px 7px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: 100%;
    width: 200px;
}

#addRow {
    margin-top: 10px;
}

</style>
<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Ubah Sistem Order Tiket</h3>
		<p>Sistem order tiket yang sedang berjalan: </p>
		<h3 id="running" style="margin:5px 0 5px 25px;"></h3>
		<br/><br/><br/><br/>
		<button id="add-kurs">Ubah Sistem</button>
		
	</div>
	<div id="end"></div>
	<div id="panel-change">
		<div class="yui3-widget-bd">
			<form id="form" name="form">
				<fieldset>
					<p>
						<label for="tipe">Ubah sistem order tiket:</label>
						<select name="system">
							<option value="internal">Internal</option>
							<option value="tiketcom">Tiketcom - tiket[dot]com</option>
						</select>
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_running_system_order();
	});
	
	function load_running_system_order(){
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_running_system_order',
			dataType: "json",
			success:function(datajson){
				$('#running').html(datajson.running);
			}
		});
	}	  
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function change_system_order(){
			var form = $('#form').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/change_system_order',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/setting_switch_order_page');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-kurs');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-change',
			headerContent: 'Perubahan Pengaturan',
			width        : 250,
			zIndex       : 5,
			centered     : true,
			modal        : true,
			visible      : false,
			render       : true,
			plugins      : [Y.Plugin.Drag]
		});
		panel.addButton({
			value  : 'Ubah',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				e.preventDefault();
				change_system_order();
			}
		});
		panel.addButton({
			value  : 'Batal',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				panel.hide();
			}
		});
		// When the addRowBtn is pressed, show the modal form.
		addRowBtn.on('click', function (e) {
			panel.show();
		});
	});
</script>

 