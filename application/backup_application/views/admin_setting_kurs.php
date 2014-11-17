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
		<h3 style="margin:5px 0 5px 5px;">Daftar Kurs</h3>
		<button id="add-kurs">Tambah Kurs</button>
		<div id="data-kurs"></div>
	</div>
	<div id="end"></div>
	<div id="panel-add-kurs">
		<div class="yui3-widget-bd">
			<form id="form-add-kurs" name="form-add-kurs">
				<fieldset>
					<p>
						<label for="tipe">Kode Mata Uang - A</label>
						<input type="text" name="currency_a" id="currency_a" placeholder="">
					</p>
					<p>
						<label for="tipe">Negara - A</label>
						<input type="text" name="country_a" id="country_a" placeholder="">
					</p>
					<p>
						<label for="tipe">Kode Mata Uang - B</label>
						<input type="text" name="currency_b" id="currency_b" placeholder="">
					</p>
					<p>
						<label for="tipe">Negara - B</label>
						<input type="text" name="country_b" id="country_b" placeholder="">
					</p>
					<p>
						<label for="tipe">Nilai Kurs</label>
						<input type="text" name="rate_in_b" id="rate" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_ym();
	});
	
	function load_ym(){
		var data_via = [];
		
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_exchanges',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, a:datajson[i].country_a+' - '+datajson[i].currency_a, b: datajson[i].country_b+' - '+datajson[i].currency_b, rate: datajson[i].rate};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_bank_via = data_via;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No."},
					{key:"a", label:"Mata Uang A"},
					{key:"b", label:"Mata Uang B"},
					{key:"rate", label:"Nilai"},
					{
						key:"id", 
						label: "Ubah",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/setting_kurs_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					},
					{
						key:"id", 
						label: "Hapus",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/kurs_delete/{value}" onclick="return prompt_delete_item();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_bank_via,
				caption: "Konversi Kurs Terdaftar",
				rowsPerPage: 10
			});
			table.render("#data-kurs");
		});
	}	  
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function add_ym(){
			var form = $('#form-add-kurs').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/kurs_add',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/setting_kurs_page');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-kurs');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-kurs',
			headerContent: 'Tambah Konversi Kurs',
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
				add_ym();
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

 