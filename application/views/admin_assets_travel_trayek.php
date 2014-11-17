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
		<h3 style="margin:5px 0 5px 5px;">Travel Trayek</h3>
		<button id="add-hotel-tipe">Tambah Travel Trayek</button>
		<div id="data-hotel-tipe"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-hotel-tipe">
		<div class="yui3-widget-bd">
			<form id="form-add-hotel-tipe" name="form-add-hotel-tipe">
				<fieldset>
					<p>
						<label for="nama">Travel Agent</label><br/>
						<input type="text" name="nama" id="nama" value="" placeholder="">
					</p>
					<p>
						<label for="trayek">Trayek</label><br/>
						<input type="text" name="trayek" id="trayek" value="" placeholder="">
					</p>
					<p>
						<label for="mobil">Mobil</label><br/>
						<input type="text" name="mobil" id="mobil" value="" placeholder="">
					</p>
					<p>
						<label for="kota_dari">Kota Dari</label><br/>
						<input type="text" name="kota_dari" id="kota_dari" value="" placeholder="">
					</p>
					<p>
						<label for="kota_ke">Kota Ke</label><br/>
						<input type="text" name="kota_ke" id="kota_ke" value="" placeholder="">
					</p>
					<p>
						<label for="jam">Jam</label><br/>
						<input type="text" name="jam" id="jam" value="" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_hotel_tipe();
	});
	
	function load_hotel_tipe(){
		var data_via = [];
			//data_via[0] = {number_row:'1', id:'1', name:'hello_support@yahoo.co.id', type: 'Support'};
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_assets_travel_trayek',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, nama:datajson[i].nama, trayek:datajson[i].trayek, mobil:datajson[i].mobil, kota_dari:datajson[i].kota_dari, kota_ke:datajson[i].kota_ke, jam:datajson[i].jam};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"nama", label:"Travel Agent"},
					{key:"trayek", label:"Trayek"},
					{key:"mobil", label:"Mobil"},
					{key:"kota_dari", label:"Kota Dari"},
					{key:"kota_ke", label:"Kota Ke"},
					{key:"jam", label:"Jam"},
					
					{
						key:"id", 
						label: "Ubah",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/travel_trayek_update/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/travel_trayek_delete/{value}" onclick="return deletechecked();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Daftar Travel Trayek",
				rowsPerPage: 10
			});
			table.render("#data-hotel-tipe");
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
			var form = $('#form-add-hotel-tipe').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/travel_trayek_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/assets_travel/trayek');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-hotel-tipe');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-hotel-tipe',
			headerContent: 'Tambah Travel Trayek',
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

 