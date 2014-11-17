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
		<h3 style="margin:5px 0 5px 5px;">Koordinat Hotel</h3>
		<button id="add-hotel-coordinate">Tambah Koordinat Hotel</button>
		<div id="data-hotel-coordinate"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-hotel-coordinate">
		<div class="yui3-widget-bd">
			<form id="form-add-hotel-coordinate" name="form-add-hotel-coordinate">
				<fieldset>
					<p>
						<label for="nama">Nama Hotel</label><br/>
						<input type="text" name="nama" id="nama" value="" placeholder="">
					</p>
					<p>
						<label for="lati">Latitude</label><br/>
						<input type="text" name="lati" id="lati" value="" placeholder="">
					</p>
					<p>
						<label for="longi">Longitude</label><br/>
						<input type="text" name="longi" id="longi" value="" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_hotel_coordinate();
	});
	
	function load_hotel_coordinate(){
		var data_via = [];
			//data_via[0] = {number_row:'1', id:'1', name:'hello_support@yahoo.co.id', type: 'Support'};
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_assets_hotel_coordinate',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, nama:datajson[i].nama, lati:datajson[i].lati, longi:datajson[i].longi };
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"nama", label:"Nama Hotel"},
					{key:"lati", label:"Latitude"},
					{key:"longi", label:"Longitude"},
					{
						key:"id", 
						label: "Ubah",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/hotel_coordinate_update/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/hotel_coordinate_delete/{value}" onclick="return deletechecked();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Daftar Koordinat Hotel",
				rowsPerPage: 10
			});
			table.render("#data-hotel-coordinate");
		});
	}
	
	function deletechecked()
	{
		var answer = confirm("Hapus data ini?")
		if (answer){
			document.messages.submit();
		}
		
		return false;  
	}	  
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function add_rute(){
			var form = $('#form-add-hotel-coordinate').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/hotel_coordinate_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/assets_hotel/hotel_coordinate');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-hotel-coordinate');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-hotel-coordinate',
			headerContent: 'Tambah Koordinat Hotel',
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

 