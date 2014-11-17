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
		<h3 style="margin:5px 0 5px 5px;">Tour Price Default</h3>
		<button id="add-hotel-tipe">Tambah Price Default</button>
		<div id="data-hotel-tipe"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-hotel-tipe">
		<div class="yui3-widget-bd">
			<form id="form-add-hotel-tipe" name="form-add-hotel-tipe">
				<fieldset>
					<p>
						<label for="agent">Tour Agent</label><br/>
						<input type="text" name="agent" id="agent" value="" placeholder="">
					</p>
					<p>
						<label for="tour_name">Tour Name</label><br/>
						<input type="text" name="tour_name" id="tour_name" value="" placeholder="">
					</p>
					<p>
						<label for="agen_price">Agent Price</label><br/>
						<input type="text" name="agen_price" id="agen_price" value="" placeholder="">
					</p>
					<p>
						<label for="price">Price</label><br/>
						<input type="text" name="price" id="price" value="" placeholder="">
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
			url: '<?php echo base_url();?>index.php/admin/get_assets_tour_price_default',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, agent:datajson[i].agent, tour_name:datajson[i].tour_name, agen_price:datajson[i].agen_price, price:datajson[i].price};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"agent", label:"Tour Agent"},
					{key:"tour_name", label:"Tour Name"},
					{key:"agen_price", label:"Agent Price"},
					{key:"price", label:"Price"},						
					{
						key:"id", 
						label: "Ubah",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/tour_price_default_update/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/tour_price_default_delete/{value}" onclick="return deletechecked();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Tour Price Default",
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
				url: '<?php echo base_url();?>index.php/admin/tour_price_default_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/assets_tour/price_default');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-hotel-tipe');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-hotel-tipe',
			headerContent: 'Tambah Price Default',
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

 