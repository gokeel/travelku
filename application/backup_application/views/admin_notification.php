<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		
		<h3 style="margin:5px 0 5px 5px;">Daftar Notifikasi</h3>
		<div id="list"></div>
		
		
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_list();
	});
	function load_list(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_notifications',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row: datajson[i].number_row, id:datajson[i].id, category: datajson[i].category, message:datajson[i].message, datetime: datajson[i].datetime};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_comm = data;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"category", label:"Kategori"},
					{key:"message", label:"Pesan Notifikasi"},
					{key:"datetime", label:"Tanggal"}
				],
				data: data_comm,
				caption: "Notifikasi",
				rowsPerPage: 30
			});
			table.render("#list");
		});
	}
</script>

 