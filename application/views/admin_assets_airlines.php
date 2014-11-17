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
		<h3 style="margin:5px 0 5px 5px;">Airlines</h3>
		<button id="add-airline">Tambah Data</button>
		<div id="data-airline"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-airline">
		<div class="yui3-widget-bd">
			<form id="form-add-airline" name="form-add-airline">
				<fieldset>
					<p>
						<label for="nama">Nama Airline</label><br/>
						<input type="text" name="nama" id="nama" placeholder="">
					</p>
					<p>
						<label for="website">Website Airline</label><br/>
						<input type="text" name="website" id="website" value="" placeholder="">
					</p>
					<p>
						<label for="kode">Kode Airline</label><br/>
						<input type="text" name="kode" id="kode" value="" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_airlines();
	});
	
	function load_airlines(){
		var data_via = [];
			//data_via[0] = {number_row:'1', id:'1', name:'hello_support@yahoo.co.id', type: 'Support'};
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_assets_airlines',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id: datajson[i].id, name:datajson[i].name, website:datajson[i].website, code:datajson[i].code};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"name", label:"Nama Airline"},
					{key:"website", label:"Website Airline"},
					{key:"code", label:"Kode Airline"},
					{
						key:"id", 
						label: "Ubah",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/airline_update/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/airline_delete/{value}" onclick="return deletechecked();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Airlines",
				rowsPerPage: 10
			});
			table.render("#data-airline");
		});
	}
	
	function deletechecked()
	{
		var answer = confirm("Hapus airline ini?")
		if (answer){
			document.messages.submit();
		}
		
		return false;  
	}	  
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function add_airline(){
			var form = $('#form-add-airline').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/airline_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/assets_airlines/airlines');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-airline');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-airline',
			headerContent: 'Tambah Airline',
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
				add_airline();
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

 