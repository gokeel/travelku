<script type="text/javascript">
YUI().use('tabview', function(Y) {
    var tabview = new Y.TabView({srcNode:'#tabs'});
    tabview.render();
});
</script>
<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		
		<h3 style="margin:5px 0 5px 5px;">Daftar Semua Komisi</h3>
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Pesawat</a></li>
				<li><a href="#tabs-2">Kereta</a></li>
				<li><a href="#tabs-3">Hotel</a></li>
				<li><a href="#tabs-4">Tour</a></li>
				<li><a href="#tabs-5">Travel</a></li>
				<li><a href="#tabs-6">Umrah</a></li>
				<li><a href="#tabs-7">Rental</a></li>
			</ul>
			<div>
				<div id="tabs-1">
					<div id="list-flight"></div>
				</div>
				<div id="tabs-2">
					<div id="list-train"></div>
				</div>
				<div id="tabs-3">
					<div id="list-hotel"></div>
				</div>
				<div id="tabs-4">
					<div id="list-tour"></div>
				</div>
				<div id="tabs-5">
					<div id="list-travel"></div>
				</div>
				<div id="tabs-6">
					<div id="list-umrah"></div>
				</div>
				<div id="tabs-7">
					<div id="list-rental"></div>
				</div>
			</div>
		</div>
		
		
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_commissions('flight');
		load_commissions('train');
		load_commissions('hotel');
		load_commissions('tour');
		load_commissions('travel');
		load_commissions('umrah');
		load_commissions('rental');
	});
	function load_commissions(category){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_commission_by_type/'+category,
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row: datajson[i].number_row, id:datajson[i].id, type: datajson[i].type, name:datajson[i].name, for_agent: datajson[i].for_agent, nominal: datajson[i].nominal, active: datajson[i].active, note: datajson[i].note};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable', function (Y) {
			/*------------------------------------*/
			var data_comm = data;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"name", label:"Label Komisi"},
					{key:"type", label:"Kategori"},
					{key:"for_agent", label:"Untuk Agen"},
					{key:"nominal", label:"Nominal"},
					{key:"active", label:"Aktif?"},
					{key:"note", label:"Keterangan"},
					{
						key:"id", 
						label: "Ubah",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/setting_commission_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_comm,
				caption: "Komisi Terdaftar"
			});
			table.render("#list-"+category);
		});
	}
</script>

 