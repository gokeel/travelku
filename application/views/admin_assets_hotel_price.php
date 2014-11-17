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
		<h3 style="margin:5px 0 5px 5px;">Daftar Harga Hotel</h3>
		<button id="add-hotel-price">Tambah Harga Hotel</button>
		<div id="data-hotel-price"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-hotel-price">
		<div class="yui3-widget-bd">
			<form id="form-add-hotel-price" name="form-add-hotel-price">
				<fieldset>
					<p>
						<label for="nama">Nama Hotel</label><br/>
						<input type="text" name="nama" id="nama" value="" placeholder="">
					</p>
					<p>
						<label for="room_type">Room Type</label><br/>
						<input type="text" name="room_type" id="room_type" value="" placeholder="">
					</p>
					<p>
						<label for="agen_price">Agen Price</label><br/>
						<input type="text" name="agen_price" id="agen_price" value="" placeholder="">
					</p>
					<p>
						<label for="price">Price</label><br/>
						<input type="text" name="price" id="price" value="" placeholder="">
					</p>
					<p>
						<label for="alot">Alot</label><br/>
						<input type="text" name="alot" id="alot" value="" placeholder="">
					</p>
					<p>
						<label for="max_guest">Max Guest</label><br/>
						<input type="text" name="max_guest" id="max_guest" value="" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_hotel_price();
	});
	
	function load_hotel_price(){
		var data_via = [];
			//data_via[0] = {number_row:'1', id:'1', name:'hello_support@yahoo.co.id', type: 'Support'};
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_assets_hotel_price',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, logo:datajson[i].logo,nama:datajson[i].nama, room_type:datajson[i].room_type, agen_price:datajson[i].agen_price, price:datajson[i].price, alot:datajson[i].alot, max_guest:datajson[i].max_guest };
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"logo", label:"Logo"},
					{key:"nama", label:"Hotel Name"},
					{key:"room_type", label:"Room Type"},
					{key:"agen_price", label:"Agen Price"},
					{key:"price", label:"Price"},
					{key:"alot", label:"Alot"},
					{key:"max_guest", label:"Max Guest"},
					{
						key:"id", 
						label: "Ubah",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/hotel_price_update/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						width: "30px",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/hotel_price_delete/{value}" onclick="return deletechecked();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Daftar Harga Hotel",
				rowsPerPage: 10
			});
			table.render("#data-hotel-price");
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
			var form = $('#form-add-hotel-price').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/hotel_price_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/assets_hotel/hotel_price');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-hotel-price');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-hotel-price',
			headerContent: 'Tambah Harga Hotel',
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

 