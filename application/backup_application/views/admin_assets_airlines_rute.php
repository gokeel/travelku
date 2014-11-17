<!--Cindy Nordiansyah--> 
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
		<h3 style="margin:5px 0 5px 5px;">Airlines Rute</h3>
		<button id="add-rute">Tambah Rute</button>
		<div id="data-rute"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-rute">
		<div class="yui3-widget-bd">
			<form id="form-add-rute" name="form-add-rute">
				<fieldset>
					<p>
						<label for="nama">Nama Airline</label><br/>
						<input type="text" name="nama" id="nama" placeholder="">
					</p>
					<p>
						<label for="akun-ym">Origin City</label><br/>
						<input type="text" name="origin" id="origin" value="" placeholder="">
					</p>
					<p>
						<label for="akun-ym">Destination City</label><br/>
						<input type="text" name="destination" id="destination" value="" placeholder="">
					</p>
					
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_rute();
	});
	
	function load_rute(){
		var data_via = [];
			//data_via[0] = {number_row:'1', id:'1', name:'hello_support@yahoo.co.id', type: 'Support'};
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_assets_airlines_rute',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, name:datajson[i].name, origin:datajson[i].origin, destination:datajson[i].destination };
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"name", label:"Nama Airline"},
					{key:"origin", label:"Origin City"},
					{key:"destination", label:"Destination City"},
					{
						key:"id", 
						label: "Ubah",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/airline_rute_update/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/airline_rute_delete/{value}" onclick="return deletechecked();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Rute Airlines",
				rowsPerPage: 10
			});
			table.render("#data-rute");
		});
	}
	
	function deletechecked()
	{
		var answer = confirm("Hapus rute ini?")
		if (answer){
			document.messages.submit();
		}
		
		return false;  
	}	  
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function add_rute(){
			var form = $('#form-add-rute').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/airline_rute_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/assets_airlines/rute');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-rute');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-rute',
			headerContent: 'Tambah Rute Penerbangan',
			width        : 250,
			zIndex       : 5,
			centered     : true,
			modal        : true,
			visible      : false,
			render       : true,
			plugins      : [Y.Plugin.Drag]
		});
		panel.addButton({
			value  : 'Simpan',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				e.preventDefault();
				add_rute();
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

 